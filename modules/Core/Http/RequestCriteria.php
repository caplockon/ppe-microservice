<?php
declare(strict_types=1);

namespace Modules\Core\Http;

use Illuminate\Http\Request;
use Modules\Core\Contracts\BuilderCriteriaInterface;

abstract class RequestCriteria implements BuilderCriteriaInterface
{
    public function __construct(
        protected Request $request
    )
    {}
}
