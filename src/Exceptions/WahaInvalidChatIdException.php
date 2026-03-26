<?php

namespace LaravelWaha\WahaMessages\Exceptions;

use InvalidArgumentException;

class WahaInvalidChatIdException extends InvalidArgumentException
{
    public function __construct(string $chatId)
    {
        parent::__construct("Invalid chat ID \"{$chatId}\". Chat ID must end with @c.us (individual) or @g.us (group). Example: 628123456789@c.us");
    }
}
