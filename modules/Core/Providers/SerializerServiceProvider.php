<?php
declare(strict_types=1);

namespace Modules\Core\Providers;

use App\Modular\ModuleServiceProvider as BaseProvider;
use Modules\Core\Contracts\SerializerInterface;
use Modules\Core\Serializer\Drivers\SymfonySerializerDriver;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class SerializerServiceProvider extends BaseProvider
{
    public function register()
    {
        parent::register();

        $this->app->singleton(SerializerInterface::class, fn () => $this->createSerializerDriver());
        $this->app->alias(SerializerInterface::class, 'serializer');
    }


    /**
     * @return SerializerInterface
     */
    protected function createSerializerDriver()
    {
        $extractors = new PropertyInfoExtractor([], [new PhpDocExtractor(), new ReflectionExtractor()]);
        $classMetadataFactory = new ClassMetadataFactory(new AttributeLoader());
        $normalizer = new ObjectNormalizer($classMetadataFactory, null, null, $extractors);
        $serializer = new Serializer([$normalizer], [new JsonEncoder()]);
        return new SymfonySerializerDriver($serializer);
    }
}
