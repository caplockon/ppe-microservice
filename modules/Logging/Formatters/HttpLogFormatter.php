<?php
declare(strict_types=1);

namespace Modules\Logging\Formatters;

use GuzzleHttp\MessageFormatterInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class HttpLogFormatter implements MessageFormatterInterface
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface|null $response
     * @param Throwable|null $error
     * @return string
     */
    public function format(RequestInterface $request, ResponseInterface $response = null, Throwable $error = null): string
    {
        return json_encode([
            'method'            => $request->getMethod(),
            'url'               => $this->takeRequestUrl($request),
            'request_body'      => $this->takeRequestBody($request),
            'request_header'    => $this->takeRequestHeader($request),
            'response_header'   => $response ? $this->takeResponseHeader($response) : '',
            'response_body'     => $response ? $this->takeResponseBody($response) : '',
            'status'            => $this->takeStatusCode($response, $error),
        ]);
    }

    /**
     * @param ResponseInterface|null $response
     * @param Throwable|null $error
     * @return int
     */
    protected function takeStatusCode(ResponseInterface $response = null, Throwable $error = null): int
    {
        return $response?->getStatusCode() ?? $error?->getCode() ?? 0;
    }

    /**
     * Take request URL
     * @param RequestInterface $request
     * @return string
     */
    protected function takeRequestUrl(RequestInterface $request): string
    {
        return ($request->getHeader('host')[0] ?? '') . $request->getRequestTarget();
    }

    /**
     * Take request body
     * @param RequestInterface $request
     * @return string
     */
    protected function takeRequestBody(RequestInterface $request): string
    {
        return (string) $request->getBody();
    }

    /**
     * Take header from request
     * @param RequestInterface $request
     * @return string
     */
    protected function takeRequestHeader(RequestInterface $request): string
    {
        return (string) json_encode($request->getHeaders());
    }

    /**
     * Take body content from response
     * @param ResponseInterface $response
     * @return string
     */
    protected function takeResponseBody(ResponseInterface $response): string
    {
        $body = $response->getBody();

        if (!$body->isSeekable()) {
            return 'RESPONSE_NOT_LOGGEABLE';
        }

        $data = $response->getBody()->__toString();
        $response->getBody()->rewind();
        return $data;
    }

    /**
     * Take header from response
     * @param ResponseInterface $response
     * @return string
     */
    protected function takeResponseHeader(ResponseInterface $response): string
    {
        return (string) json_encode($response->getHeaders());
    }
}
