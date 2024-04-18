<?php
declare(strict_types=1);

namespace Modules\Pricing\Http\Requests;

use Modules\Core\Http\FormRequest;

class PricingSearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'client_uname' => 'required|string',
        ];
    }
}
