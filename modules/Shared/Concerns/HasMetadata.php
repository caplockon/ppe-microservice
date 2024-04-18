<?php
declare(strict_types=1);

namespace Modules\Shared\Concerns;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\Shared\Models\Metadata;
use Modules\Core\Models\Model;

/**
 * @mixin Model
 * @property Metadata[] $metadata
 */
trait HasMetadata
{
    /**
     * @return MorphMany
     */
    public function metadata(): MorphMany
    {
        return $this->morphMany(Metadata::class, 'metadatable');
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getMeta(string $key): mixed
    {
        /** @var Metadata|null $metadata */
        $metadata = collect($this->metadata)->first(function (Metadata $metadata) use ($key) {
            return strcasecmp($key, $metadata->key) === 0;
        });

        return $metadata?->value;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function setMeta(string $key, mixed $value): void
    {
        /** @var Metadata|null $metadata */
        $metadata = collect($this->metadata)->first(function (Metadata $metadata) use ($key) {
            return strcasecmp($key, $metadata->key) === 0;
        });

        if (! $metadata) {
            $metadata = new Metadata();
            $metadata->key = $key;
            $collection = collect($this->metadata)->push($metadata);
            $this->setRelation('metadata', new Collection($collection->all()));
        }

        $metadata->value = $value;
        $this->metadata()->save($metadata);
    }

    /**
     * @param string $key
     * @return void
     */
    public function removeMeta(string $key): void
    {
        $this->metadata()->where('key', $key)->delete();
        $collection = collect($this->metadata)->filter(function (Metadata $metadata) use ($key) {
            return strcasecmp($key, $metadata->key) !== 0;
        });

        $this->setRelation('metadata', new Collection($collection->all()));
    }

    /**
     * @param array $metadata
     * @return void
     */
    public function syncMeta(array $metadata)
    {
        $metadata = collect($metadata);

        if ($metadata->first() instanceof Metadata) {
            $collection = $metadata;
        } else {
            $collection = $metadata->map(function ($value, $key) {
                $meta = new Metadata();
                $meta->value = $value;
                $meta->key = $key;
                return $meta;
            });
        }

        foreach ($collection as $item) {
            $this->metadata()->save($item);
        }

        $this->setRelation('metadata', new Collection($collection->all()));
        $this->metadata()->whereNotIn('key', $collection->pluck('key'))->delete();
    }
}
