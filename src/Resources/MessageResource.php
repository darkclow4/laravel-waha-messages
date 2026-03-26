<?php

namespace LaravelWaha\WahaMessages\Resources;

class MessageResource extends BaseResource
{
    /**
     * Send a text message.
     *
     * @return array<string, mixed>
     */
    public function sendText(string $chatId, string $text, ?string $session = null): array
    {
        $this->validateChatId($chatId);

        return $this->handleResponse(
            $this->http->post('/api/sendText', [
                'session' => $this->resolveSession($session),
                'chatId' => $chatId,
                'text' => $text,
            ])
        );
    }

    /**
     * Send an image message.
     *
     * @return array<string, mixed>
     */
    public function sendImage(
        string $chatId,
        string $url,
        ?string $caption = null,
        ?string $session = null,
    ): array {
        $this->validateChatId($chatId);

        return $this->handleResponse(
            $this->http->post('/api/sendImage', array_filter([
                'session' => $this->resolveSession($session),
                'chatId' => $chatId,
                'file' => ['url' => $url],
                'caption' => $caption,
            ]))
        );
    }

    /**
     * Send a file/document message.
     *
     * @return array<string, mixed>
     */
    public function sendFile(
        string $chatId,
        string $url,
        ?string $filename = null,
        ?string $session = null,
    ): array {
        $this->validateChatId($chatId);

        return $this->handleResponse(
            $this->http->post('/api/sendFile', array_filter([
                'session' => $this->resolveSession($session),
                'chatId' => $chatId,
                'file' => ['url' => $url],
                'fileName' => $filename,
            ]))
        );
    }

    /**
     * Send a video message.
     *
     * @return array<string, mixed>
     */
    public function sendVideo(
        string $chatId,
        string $url,
        ?string $caption = null,
        ?string $session = null,
    ): array {
        $this->validateChatId($chatId);

        return $this->handleResponse(
            $this->http->post('/api/sendVideo', array_filter([
                'session' => $this->resolveSession($session),
                'chatId' => $chatId,
                'file' => ['url' => $url],
                'caption' => $caption,
            ]))
        );
    }

    /**
     * Mark messages as seen in a chat.
     *
     * @return array<string, mixed>
     */
    public function sendSeen(string $chatId, ?string $session = null): array
    {
        $this->validateChatId($chatId);

        return $this->handleResponse(
            $this->http->post('/api/sendSeen', [
                'session' => $this->resolveSession($session),
                'chatId' => $chatId,
            ])
        );
    }

    /**
     * Send a location message.
     *
     * @return array<string, mixed>
     */
    public function sendLocation(
        string $chatId,
        float $latitude,
        float $longitude,
        ?string $title = null,
        ?string $session = null,
    ): array {
        $this->validateChatId($chatId);

        return $this->handleResponse(
            $this->http->post('/api/sendLocation', array_filter([
                'session' => $this->resolveSession($session),
                'chatId' => $chatId,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'title' => $title,
            ]))
        );
    }

    /**
     * Send a contact vCard message.
     *
     * @param  array<string, mixed>  $contact
     * @return array<string, mixed>
     */
    public function sendContact(string $chatId, array $contact, ?string $session = null): array
    {
        $this->validateChatId($chatId);

        return $this->handleResponse(
            $this->http->post('/api/sendContactVcard', [
                'session' => $this->resolveSession($session),
                'chatId' => $chatId,
                'contacts' => $contact,
            ])
        );
    }

    /**
     * Start typing indicator in a chat.
     *
     * @return array<string, mixed>
     */
    public function startTyping(string $chatId, ?string $session = null): array
    {
        $this->validateChatId($chatId);

        return $this->handleResponse(
            $this->http->post('/api/startTyping', [
                'session' => $this->resolveSession($session),
                'chatId' => $chatId,
            ])
        );
    }

    /**
     * Stop typing indicator in a chat.
     *
     * @return array<string, mixed>
     */
    public function stopTyping(string $chatId, ?string $session = null): array
    {
        $this->validateChatId($chatId);

        return $this->handleResponse(
            $this->http->put('/api/stopTyping', [
                'session' => $this->resolveSession($session),
                'chatId' => $chatId,
            ])
        );
    }
}
