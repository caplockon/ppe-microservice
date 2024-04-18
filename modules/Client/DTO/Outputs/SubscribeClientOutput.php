<?php
declare(strict_types=1);

namespace Modules\Client\DTO\Outputs;

use Modules\Client\DTO\Inputs\SubscribeClientInput;
use Modules\Client\Models\Client;

class SubscribeClientOutput
{
    /**
     * @var Client
     */
    public Client $client;

    public function __construct(
        public readonly SubscribeClientInput $input
    )
    {}
}
