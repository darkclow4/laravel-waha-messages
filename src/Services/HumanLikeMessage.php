<?php

namespace LaravelWaha\WahaMessages\Services;

use LaravelWaha\WahaMessages\WahaClient;

class HumanLikeMessage
{
    /**
     * Milliseconds per character for typing delay calculation.
     */
    protected int $msPerChar = 300;

    /**
     * Minimum typing delay in milliseconds.
     */
    protected int $minDelay = 2000;

    /**
     * Maximum typing delay in milliseconds.
     */
    protected int $maxDelay = 10000;

    public function __construct(
        protected WahaClient $client,
    ) {}

    /**
     * Set the typing speed in milliseconds per character.
     */
    public function msPerChar(int $ms): static
    {
        $this->msPerChar = $ms;

        return $this;
    }

    /**
     * Set the minimum typing delay in milliseconds.
     */
    public function minDelay(int $ms): static
    {
        $this->minDelay = $ms;

        return $this;
    }

    /**
     * Set the maximum typing delay in milliseconds.
     */
    public function maxDelay(int $ms): static
    {
        $this->maxDelay = $ms;

        return $this;
    }

    /**
     * Send a text message with human-like behavior.
     *
     * Flow: seen → startTyping → delay → stopTyping → sendText
     *
     * @return array<string, mixed>
     */
    public function sendText(string $chatId, string $text, ?string $session = null): array
    {
        $messages = $this->client->messages();

        $messages->sendSeen($chatId, $session);

        $messages->startTyping($chatId, $session);

        $this->sleepForTyping($text);

        $messages->stopTyping($chatId, $session);

        return $messages->sendText($chatId, $text, $session);
    }

    /**
     * Calculate and sleep for the typing duration based on text length.
     */
    protected function sleepForTyping(string $text): void
    {
        $delay = mb_strlen($text) * $this->msPerChar;
        $delay = max($this->minDelay, min($this->maxDelay, $delay));

        usleep($delay * 1000);
    }
}
