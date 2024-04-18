<?php
declare(strict_types=1);

namespace Modules\Core\Serializer;

class BaseDTO
{
    /**
     * Export object to array
     * @return array
     */
    public function toArray(): array
    {
        $json = $this->toJson();
        $data = $json ? json_decode($json, true) : [];
        return is_array($data) ? $data : [];
    }

    /**
     * Serializer object to json
     * @return string
     */
    public function toJson(): string
    {
        return Serializer::serialize($this, Format::JSON);
    }

    /**
     * @param $data
     * @return static
     */
    public static function fromJson($data)
    {
        return Serializer::deserialize($data, static::class, Format::JSON);
    }

    /**
     * @param $data
     * @return static
     */
    public static function fromArray($data)
    {
        return self::fromJson(json_encode($data));
    }
}
