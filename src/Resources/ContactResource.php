<?php

namespace LaravelWaha\WahaMessages\Resources;

class ContactResource extends BaseResource
{
    /**
     * List all contacts.
     *
     * @return array<int, mixed>
     */
    public function list(?int $limit = null, ?int $offset = null, ?string $session = null): array
    {
        return $this->handleResponse(
            $this->http->get('/api/contacts/all', array_filter([
                'session' => $this->resolveSession($session),
                'limit' => $limit,
                'offset' => $offset,
            ]))
        );
    }

    /**
     * Get a specific contact.
     *
     * @return array<string, mixed>
     */
    public function get(string $contactId, ?string $session = null): array
    {
        return $this->handleResponse(
            $this->http->get('/api/contacts', [
                'contactId' => $contactId,
                'session' => $this->resolveSession($session),
            ])
        );
    }

    /**
     * Check if a phone number exists on WhatsApp.
     *
     * @return array<string, mixed>
     */
    public function checkExists(string $phone, ?string $session = null): array
    {
        return $this->handleResponse(
            $this->http->get('/api/contacts/check-exists', [
                'phone' => $phone,
                'session' => $this->resolveSession($session),
            ])
        );
    }

    /**
     * Get a contact's profile picture URL.
     *
     * @return array<string, mixed>
     */
    public function profilePicture(string $contactId, ?string $session = null): array
    {
        return $this->handleResponse(
            $this->http->get('/api/contacts/profile-picture', [
                'contactId' => $contactId,
                'session' => $this->resolveSession($session),
            ])
        );
    }

    /**
     * Get a contact's "about" text.
     *
     * @return array<string, mixed>
     */
    public function about(string $contactId, ?string $session = null): array
    {
        return $this->handleResponse(
            $this->http->get('/api/contacts/about', [
                'contactId' => $contactId,
                'session' => $this->resolveSession($session),
            ])
        );
    }

    /**
     * Block a contact.
     *
     * @return array<string, mixed>
     */
    public function block(string $contactId, ?string $session = null): array
    {
        return $this->handleResponse(
            $this->http->post('/api/contacts/block', [
                'contactId' => $contactId,
                'session' => $this->resolveSession($session),
            ])
        );
    }

    /**
     * Unblock a contact.
     *
     * @return array<string, mixed>
     */
    public function unblock(string $contactId, ?string $session = null): array
    {
        return $this->handleResponse(
            $this->http->post('/api/contacts/unblock', [
                'contactId' => $contactId,
                'session' => $this->resolveSession($session),
            ])
        );
    }
}
