<?php
declare(strict_types=1);

namespace Modules\Libraries\LenderPriceSDK;


class LenderPriceClient
{
    /**
     * @var LenderPriceCredentials
     */
    protected LenderPriceCredentials $credentials;

    /**
     * New client instance
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        // Setup API credentials
        $credentials = $options[LenderPriceCredentials::class] ?? null;
        $this->credentials = $credentials instanceof LenderPriceCredentials
            ? $credentials
            : new LenderPriceCredentials(); // Empty credentials
    }
}
