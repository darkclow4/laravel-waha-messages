<?php

namespace LaravelWaha\WahaMessages\Facades;

use Illuminate\Support\Facades\Facade;
use LaravelWaha\WahaMessages\Resources\ChatResource;
use LaravelWaha\WahaMessages\Resources\ContactResource;
use LaravelWaha\WahaMessages\Resources\GroupResource;
use LaravelWaha\WahaMessages\Resources\MessageResource;
use LaravelWaha\WahaMessages\Resources\SessionResource;
use LaravelWaha\WahaMessages\WahaClient;

/**
 * @method static SessionResource sessions()
 * @method static MessageResource messages()
 * @method static ChatResource chats()
 * @method static GroupResource groups()
 * @method static ContactResource contacts()
 *
 * @see WahaClient
 */
class Waha extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return WahaClient::class;
    }
}
