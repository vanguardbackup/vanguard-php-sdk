<?php

namespace VanguardBackup\Vanguard\Actions;

use VanguardBackup\Vanguard\Resources\RemoteServer;

trait ManagesRemoteServers
{
    /**
     * Get the collection of remote servers.
     *
     * @return RemoteServer[]
     */
    public function remoteServers()
    {
        return $this->transformCollection(
            $this->get('remote-servers')['data'], RemoteServer::class
        );
    }

    /**
     * Get a remote server instance.
     *
     * @param string $serverId
     * @return RemoteServer
     */
    public function remoteServer(string $serverId): RemoteServer
    {
        return new RemoteServer($this->get("remote-servers/{$serverId}")['data'], $this);
    }

    /**
     * Create a new remote server.
     *
     * @param array $data
     * @return RemoteServer
     */
    public function createRemoteServer(array $data): RemoteServer
    {
        return new RemoteServer($this->post('remote-servers', $data)['data'], $this);
    }

    /**
     * Update the given remote server.
     *
     * @param string $serverId
     * @param array $data
     * @return RemoteServer
     */
    public function updateRemoteServer(string $serverId, array $data): RemoteServer
    {
        return new RemoteServer($this->put("remote-servers/{$serverId}", $data)['data'], $this);
    }

    /**
     * Delete the given remote server.
     *
     * @param string $serverId
     * @return void
     */
    public function deleteRemoteServer(string $serverId): void
    {
        $this->delete("remote-servers/{$serverId}");
    }
}