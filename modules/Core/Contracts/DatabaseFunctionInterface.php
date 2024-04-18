<?php
declare(strict_types=1);

namespace Modules\Core\Contracts;

interface DatabaseFunctionInterface
{
    /**
     * UID generator function
     * @return mixed
     */
    public function uid(): mixed;
}
