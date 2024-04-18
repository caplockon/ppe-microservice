<?php
declare(strict_types=1);

namespace Modules\Pricing\Http\Controllers;

use Modules\Pricing\Contracts\Services\PricingServiceInterface;
use Modules\Pricing\DTO\Inputs\PricingSearchInput;
use Modules\Pricing\Http\Requests\PricingSearchRequest;

class PricingController extends Controller
{
    public function __construct(
        protected readonly PricingServiceInterface $pricingService
    )
    {}

    /**
     * @param PricingSearchRequest $request
     * @return mixed
     */
    public function search(PricingSearchRequest $request)
    {
        $input = PricingSearchInput::fromArray($request->all());
        $output = $this->pricingService->search($input);

        return response([
            'data' => $output->toArray(),
        ]);
    }
}
