<?php

namespace LaravelWaha\WahaMessages\Resources;

class SessionResource extends BaseResource
{
    /**
     * List all sessions.
     *
     * @return array<int, mixed>
     */
    public function list(): array
    {
        return $this->handleResponse(
            $this->http->get('/api/sessions')
        );
    }

    /**
     * Get a specific session.
     *
     * @return array<string, mixed>
     */
    public function get(string $session): array
    {
        return $this->handleResponse(
            $this->http->get("/api/sessions/{$session}")
        );
    }

    /**
     * Create a new session.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function create(array $data = []): array
    {
        return $this->handleResponse(
            $this->http->post('/api/sessions', $data)
        );
    }

    /**
     * Update a session.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function update(string $session, array $data): array
    {
        return $this->handleResponse(
            $this->http->put("/api/sessions/{$session}", $data)
        );
    }

    /**
     * Delete a session.
     *
     * @return array<string, mixed>
     */
    public function delete(string $session): array
    {
        return $this->handleResponse(
            $this->http->delete("/api/sessions/{$session}")
        );
    }

    /**
     * Start a session.
     *
     * @return array<string, mixed>
     */
    public function start(string $session): array
    {
        return $this->handleResponse(
            $this->http->post("/api/sessions/{$session}/start")
        );
    }

    /**
     * Stop a session.
     *
     * @return array<string, mixed>
     */
    public function stop(string $session): array
    {
        return $this->handleResponse(
            $this->http->post("/api/sessions/{$session}/stop")
        );
    }

    /**
     * Logout from a session.
     *
     * @return array<string, mixed>
     */
    public function logout(string $session): array
    {
        return $this->handleResponse(
            $this->http->post("/api/sessions/{$session}/logout")
        );
    }

    /**
     * Get the QR code for session authentication.
     *
     * @return array<string, mixed>
     */
    public function qr(string $session): array
    {
        return $this->handleResponse(
            $this->http->get("/api/{$session}/auth/qr")
        );
    }

    /**
     * Request an authentication code.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function requestCode(string $session, array $data = []): array
    {
        return $this->handleResponse(
            $this->http->post("/api/{$session}/auth/request-code", $data)
        );
    }
}
