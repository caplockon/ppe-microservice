<?php
declare(strict_types=1);

namespace Modules\Core\Serializer;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Modules\Core\Contracts\SerializerInterface
 */
class Serializer extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'serializer';
    }

    /**
     * Deserialize data to object
     *
     * @template T
     * @param mixed $data
     * @param class-string<T> $class
     * @param Format $type
     * @return T
     */
    public static function deserialize(mixed $data, string $class, Format $type = Format::JSON): mixed
    {
        return self::__callStatic('deserialize', func_get_args());
    }

    /**
     * Serialize object
     *
     * @param mixed $object
     * @param Format $type
     * @return mixed
     */
    public static function serialize(mixed $object, Format $type = Format::JSON): mixed
    {
        return self::__callStatic('serialize', func_get_args());
    }
}
