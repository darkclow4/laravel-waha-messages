<?php

namespace LaravelWaha\WahaMessages\Resources;

class ChatResource extends BaseResource
{
    /**
     * Get chats overview.
     *
     * @return array<int, mixed>
     */
    public function overview(?string $session = null): array
    {
        $session = $this->resolveSession($session);

        return $this->handleResponse(
            $this->http->get("/api/{$session}/chats/overview")
        );
    }

    /**
     * Get messages from a specific chat.
     *
     * @return array<int, mixed>
     */
    public function messages(string $chatId, ?int $limit = null, ?string $session = null): array
    {
        $this->validateChatId($chatId);
        $session = $this->resolveSession($session);

        return $this->handleResponse(
            $this->http->get("/api/{$session}/chats/{$chatId}/messages", array_filter([
                'limit' => $limit,
            ]))
        );
    }

    /**
     * Delete a chat.
     *
     * @return array<string, mixed>
     */
    public function deleteChat(string $chatId, ?string $session = null): array
    {
        $this->validateChatId($chatId);
        $session = $this->resolveSession($session);

        return $this->handleResponse(
            $this->http->delete("/api/{$session}/chats/{$chatId}")
        );
    }
}
