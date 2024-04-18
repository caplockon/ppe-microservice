<?php
declare(strict_types=1);

namespace Modules\Pricing\DTO\Outputs;

use Modules\Core\Serializer\BaseDTO;
use Modules\Pricing\DTO\Inputs\PricingSearchInput;

class PricingSearchOutput extends BaseDTO
{
    /**
     * @var array
     */
    public array $eligible_products = [];

    /**
     * @var array
     */
    public array $ineligible_products = [];

    /**
     * @var string
     */
    public string $request_id;

    public function __construct(
        public readonly PricingSearchInput $input
    )
    {}
}
