<?php
declare(strict_types=1);

namespace Modules\Client\DTO\Inputs;

use Modules\Client\DTO\PricingEngineDTO;
use Modules\Core\Serializer\BaseDTO;

class SubscribeClientInput extends BaseDTO
{
    /**
     * @var string
     */
    public string $uname;

    /**
     * @var string|null
     */
    public ?string $name = null;

    /**
     * @var PricingEngineDTO
     */
    public PricingEngineDTO $pricing_engine;
}
