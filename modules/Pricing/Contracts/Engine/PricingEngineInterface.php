<?php
declare(strict_types=1);

namespace Modules\Pricing\Contracts\Engine;

use Modules\Client\Models\Client;

interface PricingEngineInterface
{
    /**
     * Pricing name
     * @return string
     */
    public function getName(): string;

    /**
     * @return array
     */
    public function getCredentialsValidationRules(): array;

    /**
     * @param mixed $credentials
     * @return array
     */
    public function encryptCredentials(mixed $credentials): mixed;

    /**
     * @param array $credentials
     * @return mixed
     */
    public function decryptCredentials(mixed $credentials): mixed;

    /**
     * @param Client $client
     * @param mixed $credentials
     * @return PricingExecutorInterface
     */
    public function createPricingExecutor(Client $client, mixed $credentials): PricingExecutorInterface;
}
