<?php

namespace LaravelWaha\WahaMessages\Resources;

use LaravelWaha\WahaMessages\Exceptions\WahaException;

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
     * @param  string  $format  'raw', 'base64', or 'binary'
     * @return array<string, mixed>|string
     */
    public function qr(string $session, string $format = 'raw'): array|string
    {
        $http = clone $this->http;

        if ($format === 'base64') {
            return $this->handleResponse(
                $http->acceptJson()->get("/api/{$session}/auth/qr", ['format' => 'image'])
            );
        }

        if ($format === 'binary') {
            $response = $http->accept('image/png')->get("/api/{$session}/auth/qr", ['format' => 'image']);

            if ($response->failed()) {
                throw WahaException::fromResponse($response);
            }

            return $response->body();
        }

        return $this->handleResponse(
            $http->get("/api/{$session}/auth/qr", ['format' => 'raw'])
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
