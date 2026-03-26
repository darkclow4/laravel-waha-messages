<?php

namespace LaravelWaha\WahaMessages\Exceptions;

use Illuminate\Http\Client\Response;
use RuntimeException;

class WahaException extends RuntimeException
{
    protected int $statusCode;

    /** @var array<string, mixed> */
    protected array $responseBody;

    /**
     * @param  array<string, mixed>  $responseBody
     */
    public function __construct(string $message, int $statusCode = 0, array $responseBody = [])
    {
        parent::__construct($message, $statusCode);

        $this->statusCode = $statusCode;
        $this->responseBody = $responseBody;
    }

    /**
     * Create an exception from an HTTP response.
     */
    public static function fromResponse(Response $response): static
    {
        $body = $response->json() ?? [];
        $message = $body['message'] ?? "WAHA API error: {$response->status()}";
        $statusCode = $response->status();

        return match (true) {
            $statusCode === 401 => new WahaAuthenticationException($message, $statusCode, $body),
            $statusCode === 404 => new WahaNotFoundException($message, $statusCode, $body),
            default => new static($message, $statusCode, $body),
        };
    }

    /**
     * Get the HTTP status code.
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Get the response body.
     *
     * @return array<string, mixed>
     */
    public function getResponseBody(): array
    {
        return $this->responseBody;
    }
}
