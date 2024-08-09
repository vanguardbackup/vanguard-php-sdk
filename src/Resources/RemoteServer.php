<?php

namespace VanguardBackup\Vanguard\Resources;

class RemoteServer extends Resource
{
    /**
     * The id of the remote server.
     *
     * @var int
     */
    public $id;

    /**
     * The user id associated with the remote server.
     *
     * @var int
     */
    public $userId;

    /**
     * The label of the remote server.
     *
     * @var string
     */
    public $label;

    /**
     * The connection details of the remote server.
     *
     * @var array
     */
    public $connection;

    /**
     * The status of the remote server.
     *
     * @var array
     */
    public $status;

    /**
     * The date/time the remote server was created.
     *
     * @var string
     */
    public $createdAt;

    /**
     * The date/time the remote server was last updated.
     *
     * @var string
     */
    public $updatedAt;

    /**
     * Update the given remote server.
     *
     * @param array $data
     * @return \VanguardBackup\Vanguard\Resources\RemoteServer
     */
    public function update(array $data)
    {
        return $this->client->updateRemoteServer($this->id, $data);
    }

    /**
     * Delete the given remote server.
     *
     * @return void
     */
    public function delete()
    {
        $this->client->deleteRemoteServer($this->id);
    }

    /**
     * Get the IP address of the remote server.
     *
     * @return string
     */
    public function getIpAddress(): string
    {
        return $this->connection['ip_address'];
    }

    /**
     * Get the username for the remote server connection.
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->connection['username'];
    }

    /**
     * Get the port for the remote server connection.
     *
     * @return int
     */
    public function getPort(): int
    {
        return $this->connection['port'];
    }

    /**
     * Check if a database password is set for the remote server.
     *
     * @return bool
     */
    public function isDatabasePasswordSet(): bool
    {
        return $this->connection['is_database_password_set'];
    }

    /**
     * Get the connectivity status of the remote server.
     *
     * @return string
     */
    public function getConnectivityStatus(): string
    {
        return $this->status['connectivity'];
    }

    /**
     * Get the last connected timestamp of the remote server.
     *
     * @return string|null
     */
    public function getLastConnectedAt(): ?string
    {
        return $this->status['last_connected_at'];
    }

    /**
     * Check if the remote server is currently connected.
     *
     * @return bool
     */
    public function isConnected(): bool
    {
        return $this->getConnectivityStatus() === 'connected';
    }
}