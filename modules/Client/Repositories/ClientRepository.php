<?php
declare(strict_types=1);

namespace Modules\Client\Repositories;

use Modules\Client\Contracts\Repositories\ClientRepositoryInterface;
use Modules\Client\Models\Client;
use Modules\Core\Repositories\BaseRepository;

class ClientRepository extends BaseRepository implements ClientRepositoryInterface
{
    /**
     * @var string
     */
    protected string $model = Client::class;

    /**
     * @inheritDoc
     */
    public function getByUname(string $uname): ?Client
    {
        /** @var Client|null $client */
        $client = Client::withTrashed()->where('uname', $uname)->first();
        return $client;
    }
}
