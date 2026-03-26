<?php

namespace LaravelWaha\WahaMessages;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use LaravelWaha\WahaMessages\Resources\ChatResource;
use LaravelWaha\WahaMessages\Resources\ContactResource;
use LaravelWaha\WahaMessages\Resources\GroupResource;
use LaravelWaha\WahaMessages\Resources\MessageResource;
use LaravelWaha\WahaMessages\Resources\SessionResource;
use LaravelWaha\WahaMessages\Services\HumanLikeMessage;

class WahaClient
{
    protected PendingRequest $http;

    protected string $defaultSession;

    /**
     * @param  array{url: string, api_key: ?string, session: string, timeout: int, connect_timeout: int, retry: array{times: int, sleep: int}}  $config
     */
    public function __construct(array $config)
    {
        $this->defaultSession = $config['session'] ?? 'default';

        $this->http = Http::baseUrl(rtrim($config['url'], '/'))
            ->timeout($config['timeout'] ?? 30)
            ->connectTimeout($config['connect_timeout'] ?? 10)
            ->retry(
                $config['retry']['times'] ?? 3,
                $config['retry']['sleep'] ?? 100,
            )
            ->acceptJson()
            ->asJson();

        if (! empty($config['api_key'])) {
            $this->http->withHeader('X-Api-Key', $config['api_key']);
        }
    }

    /**
     * Get the underlying HTTP client.
     */
    public function getHttp(): PendingRequest
    {
        return $this->http;
    }

    /**
     * Get the default session name.
     */
    public function getDefaultSession(): string
    {
        return $this->defaultSession;
    }

    /**
     * Session management resource.
     */
    public function sessions(): SessionResource
    {
        return new SessionResource($this->http, $this->defaultSession);
    }

    /**
     * Message sending resource.
     */
    public function messages(): MessageResource
    {
        return new MessageResource($this->http, $this->defaultSession);
    }

    /**
     * Chat management resource.
     */
    public function chats(): ChatResource
    {
        return new ChatResource($this->http, $this->defaultSession);
    }

    /**
     * Group management resource.
     */
    public function groups(): GroupResource
    {
        return new GroupResource($this->http, $this->defaultSession);
    }

    /**
     * Contact management resource.
     */
    public function contacts(): ContactResource
    {
        return new ContactResource($this->http, $this->defaultSession);
    }

    /**
     * Human-like messaging service with typing simulation.
     */
    public function humanLike(): HumanLikeMessage
    {
        return new HumanLikeMessage($this);
    }
}
