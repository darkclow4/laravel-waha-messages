<?php

namespace LaravelWaha\WahaMessages\Resources;

class GroupResource extends BaseResource
{
    /**
     * List all groups.
     *
     * @return array<int, mixed>
     */
    public function list(?string $session = null): array
    {
        $session = $this->resolveSession($session);

        return $this->handleResponse(
            $this->http->get("/api/{$session}/groups")
        );
    }

    /**
     * Create a new group.
     *
     * @param  array<int, string>  $participants
     * @return array<string, mixed>
     */
    public function create(string $name, array $participants = [], ?string $session = null): array
    {
        $session = $this->resolveSession($session);

        return $this->handleResponse(
            $this->http->post("/api/{$session}/groups", [
                'name' => $name,
                'participants' => $participants,
            ])
        );
    }

    /**
     * Get group details.
     *
     * @return array<string, mixed>
     */
    public function get(string $groupId, ?string $session = null): array
    {
        $this->validateChatId($groupId);
        $session = $this->resolveSession($session);

        return $this->handleResponse(
            $this->http->get("/api/{$session}/groups/{$groupId}")
        );
    }

    /**
     * Add participants to a group.
     *
     * @param  array<int, string>  $participants
     * @return array<string, mixed>
     */
    public function addParticipants(string $groupId, array $participants, ?string $session = null): array
    {
        $this->validateChatId($groupId);
        $session = $this->resolveSession($session);

        return $this->handleResponse(
            $this->http->post("/api/{$session}/groups/{$groupId}/participants/add", [
                'participants' => $participants,
            ])
        );
    }

    /**
     * Remove participants from a group.
     *
     * @param  array<int, string>  $participants
     * @return array<string, mixed>
     */
    public function removeParticipants(string $groupId, array $participants, ?string $session = null): array
    {
        $this->validateChatId($groupId);
        $session = $this->resolveSession($session);

        return $this->handleResponse(
            $this->http->post("/api/{$session}/groups/{$groupId}/participants/remove", [
                'participants' => $participants,
            ])
        );
    }
}
