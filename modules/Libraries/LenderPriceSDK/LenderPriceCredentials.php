<?php
declare(strict_types=1);

namespace Modules\Libraries\LenderPriceSDK;

use Modules\Core\Serializer\BaseDTO;

class LenderPriceCredentials extends BaseDTO
{
    /**
     * @var string|null
     */
    public ?string $base_url = null;

    /**
     * @var string|null
     */
    public ?string $api_key = null;

    /**
     * @var string|null
     */
    public ?string $user_id = null;

    /**
     * @var string|null
     */
    public ?string $company_id = null;
}
