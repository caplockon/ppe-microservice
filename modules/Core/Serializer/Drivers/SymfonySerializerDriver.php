<?php
declare(strict_types=1);

namespace Modules\Core\Serializer\Drivers;

use Modules\Core\Contracts\SerializerInterface;
use Modules\Core\Serializer\Format;
use Symfony\Component\Serializer\Serializer;

class SymfonySerializerDriver implements SerializerInterface
{
    public function __construct(
        protected Serializer $serializer
    )
    {}

    /**
     * @param mixed $data
     * @param string $class
     * @param Format $type
     * @return mixed
     */
    public function deserialize(mixed $data, string $class, Format $type = Format::JSON): mixed
    {
        return $this->serializer->deserialize($data, $class, $type->value);
    }

    /**
     * @param mixed $object
     * @param Format $type
     * @return mixed
     */
    public function serialize(mixed $object, Format $type = Format::JSON): mixed
    {
        return $this->serializer->serialize($object, $type->value);
    }
}
