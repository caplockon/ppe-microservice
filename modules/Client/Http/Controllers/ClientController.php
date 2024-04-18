<?php
declare(strict_types=1);

namespace Modules\Client\Http\Controllers;

use Modules\Client\Contracts\Services\ClientServiceInterface;
use Modules\Client\DTO\Inputs\SubscribeClientInput;
use Modules\Client\Http\Requests\SubscribeClientRequest;
use Modules\Client\Http\Resources\ClientResource;
use Throwable;

class ClientController extends Controller
{
    public function __construct(
        private readonly ClientServiceInterface $clientService
    )
    {}

    /**
     * @param SubscribeClientRequest $request
     * @return mixed
     * @throws Throwable//composer require "phpdocumentor/reflection-docblock"
     */
    public function subscribe(SubscribeClientRequest $request)
    {
        $input = SubscribeClientInput::fromArray($request->all());
        $output = $this->clientService->subscribeClient($input);
        return new ClientResource($output->client);
    }
}
