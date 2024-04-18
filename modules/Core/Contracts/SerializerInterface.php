<?php
declare(strict_types=1);

namespace Modules\Core\Contracts;

use Modules\Core\Serializer\Format;

interface SerializerInterface
{
    /**
     * Deserialize data to object
     *
     * @template T
     * @param mixed $data
     * @param class-string<T> $class
     * @param Format $type
     * @return T
     */
    public function deserialize(mixed $data, string $class, Format $type = Format::JSON): mixed;

    /**
     * Serialize object
     *
     * @param mixed $object
     * @param Format $type
     * @return mixed
     */
    public function serialize(mixed $object, Format $type = Format::JSON): mixed;
}
