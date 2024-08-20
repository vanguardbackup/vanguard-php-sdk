<?php

declare(strict_types=1);

namespace VanguardBackup\Vanguard\Actions;

use Exception;
use VanguardBackup\Vanguard\Resources\RemoteServer;

trait ManagesRemoteServers
{
    /**
     * Get the collection of remote servers.
     *
     * @return RemoteServer[]
     *
     * @throws Exception
     */
    public function remoteServers(): array
    {
        return $this->transformCollection(
            $this->get('remote-servers')['data'], RemoteServer::class
        );
    }

    /**
     * Get a remote server instance.
     */
    public function remoteServer(string $serverId): RemoteServer
    {
        return new RemoteServer($this->get("remote-servers/{$serverId}")['data'], $this);
    }

    /**
     * Create a new remote server.
     */
    public function createRemoteServer(array $data): RemoteServer
    {
        return new RemoteServer($this->post('remote-servers', $data)['data'], $this);
    }

    /**
     * Update the given remote server.
     */
    public function updateRemoteServer(string $serverId, array $data): RemoteServer
    {
        return new RemoteServer($this->put("remote-servers/{$serverId}", $data)['data'], $this);
    }

    /**
     * Delete the given remote server.
     */
    public function deleteRemoteServer(string $serverId): void
    {
        $this->delete("remote-servers/{$serverId}");
    }
}
