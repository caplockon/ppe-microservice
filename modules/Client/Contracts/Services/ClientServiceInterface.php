<?php
declare(strict_types=1);

namespace Modules\Client\Contracts\Services;

use Modules\Client\DTO\Inputs\SubscribeClientInput;
use Modules\Client\DTO\Outputs\SubscribeClientOutput;
use Throwable;

interface ClientServiceInterface
{
    /**
     * @param SubscribeClientInput $input
     * @return SubscribeClientOutput
     * @throws Throwable
     */
    public function subscribeClient(SubscribeClientInput $input): SubscribeClientOutput;
}
