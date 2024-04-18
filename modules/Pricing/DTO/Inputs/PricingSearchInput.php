<?php
declare(strict_types=1);

namespace Modules\Pricing\DTO\Inputs;

use Modules\Core\Serializer\BaseDTO;

class PricingSearchInput extends BaseDTO
{
    /**
     * @var string|null
     */
    public ?string $client_uname = null;
}
