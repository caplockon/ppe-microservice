<?php
declare(strict_types=1);

namespace Modules\Logging\Drivers;

use Exception;
use Modules\Logging\Contracts\Repositories\ApiLogRepositoryInterface;
use Modules\Logging\Models\ApiLog;
use Psr\Log\LoggerInterface;
use Stringable;

class ApiLogDatabaseDriver implements LoggerInterface
{
    /**
     * @var string
     */
    protected string $logName = 'API';

    public function __construct(
        protected readonly ApiLogRepositoryInterface $apiLogRepository
    )
    {}

    public function emergency(Stringable|string $message, array $context = []): void
    {
        $this->log(__METHOD__, $message, $context);
    }

    public function alert(Stringable|string $message, array $context = []): void
    {
        $this->log(__METHOD__, $message, $context);
    }

    public function critical(Stringable|string $message, array $context = []): void
    {
        $this->log(__METHOD__, $message, $context);
    }

    public function error(Stringable|string $message, array $context = []): void
    {
        $this->log(__METHOD__, $message, $context);
    }

    public function warning(Stringable|string $message, array $context = []): void
    {
        $this->log(__METHOD__, $message, $context);
    }

    public function notice(Stringable|string $message, array $context = []): void
    {
        $this->log(__METHOD__, $message, $context);
    }

    public function info(Stringable|string $message, array $context = []): void
    {
        $this->log(__METHOD__, $message, $context);
    }

    public function debug(Stringable|string $message, array $context = []): void
    {
        $this->log(__METHOD__, $message, $context);
    }

    /**
     * @inheritDoc
     */
    public function log($level, Stringable|string $message, array $context = []): void
    {
        $data = json_decode($message, true);
        if ($data) {
            $log = new ApiLog();
            $log->name = $this->logName;
            $log->fill($data);
            $log->trace_log = (new Exception())->getTraceAsString();
            $this->apiLogRepository->save($log);
            $this->afterLog($log, $level, $message, $context);
        }
    }

    /**
     * @param ApiLog $log
     * @param $level
     * @param Stringable|string $message
     * @param array $context
     * @return void
     */
    protected function afterLog(ApiLog $log, $level, Stringable|string $message, array $context = [])
    {}
}
