<?php
declare(strict_types=1);

namespace Modules\Client\DTO;

use Modules\Core\Serializer\BaseDTO;

class PricingEngineDTO extends BaseDTO
{
    /**
     * @var string
     */
    public string $engine_driver;

    /**
     * @var array|null
     */
    public ?array $engine_credentials = null;
}
