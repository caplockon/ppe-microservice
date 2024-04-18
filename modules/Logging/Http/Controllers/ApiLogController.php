<?php
declare(strict_types=1);

namespace Modules\Logging\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Logging\Contracts\Repositories\ApiLogRepositoryInterface;
use Modules\Logging\Drivers\ApiLogDatabaseDriver;
use Modules\Logging\Formatters\HttpLogFormatter;
use Modules\Logging\Http\Requests\ApiLogGetListRequest;
use Modules\Logging\Http\Resources\ApiLogResource;
use Modules\Logging\Models\ApiLog;
use Stringable;

class ApiLogController extends Controller
{
    /**
     * @return ApiLogResource
     * @throws GuzzleException
     */
    public function test()
    {
        $driver = new class extends ApiLogDatabaseDriver
        {
            protected string $logName = 'jsontest';

            public function __construct()
            {
                parent::__construct(app(ApiLogRepositoryInterface::class));
            }

            protected function afterLog(ApiLog $log, $level, Stringable|string $message, array $context = [])
            {
                $log->syncMeta([
                    'test_log' => '1'
                ]);
            }
        };

        $handler = HandlerStack::create();
        $handler->push(Middleware::log(
            $driver,
            app(HttpLogFormatter::class),
        ));

        $client = new Client([
            'handler' => $handler,
        ]);

        $client->post('http://ip.jsontest.com/', [
            'json' => json_encode(['test' => 'data'])
        ]);

        $log = ApiLog::with('metadata')->where('name', 'jsontest')->orderByDesc('id')->first();
        return new ApiLogResource($log);
    }

    /**
     * @param ApiLogGetListRequest $request
     * @return AnonymousResourceCollection
     */
    public function list(ApiLogGetListRequest $request)
    {
        $query = ApiLog::with('metadata');
        $query = $request->applyCriteria($query);

        return ApiLogResource::collection($query->paginate($request->get('per_page', 20)));
    }
}
