<?php

namespace LaravelWaha\WahaMessages\Resources;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use LaravelWaha\WahaMessages\Exceptions\WahaException;
use LaravelWaha\WahaMessages\Exceptions\WahaInvalidChatIdException;

abstract class BaseResource
{
    public function __construct(
        protected PendingRequest $http,
        protected string $defaultSession,
    ) {}

    /**
     * Resolve the session name, falling back to the default.
     */
    protected function resolveSession(?string $session = null): string
    {
        return $session ?? $this->defaultSession;
    }

    /**
     * Validate that a chat ID has the correct format.
     *
     * @throws WahaInvalidChatIdException
     */
    protected function validateChatId(string $chatId): void
    {
        if (! str_ends_with($chatId, '@c.us') && ! str_ends_with($chatId, '@g.us')) {
            throw new WahaInvalidChatIdException($chatId);
        }
    }

    /**
     * Handle the API response, throwing on errors.
     *
     * @return array<string, mixed>
     */
    protected function handleResponse(Response $response): array
    {
        if ($response->failed()) {
            throw WahaException::fromResponse($response);
        }

        return $response->json() ?? [];
    }
}
