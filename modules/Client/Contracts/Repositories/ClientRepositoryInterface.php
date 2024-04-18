<?php
declare(strict_types=1);

namespace Modules\Client\Contracts\Repositories;

use Modules\Client\Models\Client;
use Modules\Core\Contracts\RepositoryInterface;

interface ClientRepositoryInterface extends RepositoryInterface
{
    /**
     * @param string $uname
     * @return Client|null
     */
    public function getByUname(string $uname): ?Client;
}
