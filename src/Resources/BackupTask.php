<?php

namespace VanguardBackup\Vanguard\Resources;

class BackupTask extends Resource
{
    /**
     * The id of the backup task.
     *
     * @var int
     */
    public $id;

    /**
     * The user id associated with the backup task.
     *
     * @var int
     */
    public $userId;

    /**
     * The remote server id associated with the backup task.
     *
     * @var int
     */
    public $remoteServerId;

    /**
     * The backup destination id associated with the backup task.
     *
     * @var int
     */
    public $backupDestinationId;

    /**
     * The label of the backup task.
     *
     * @var string
     */
    public $label;

    /**
     * The description of the backup task.
     *
     * @var string|null
     */
    public $description;

    /**
     * The source configuration of the backup task.
     *
     * @var array
     */
    public $source;

    /**
     * The schedule configuration of the backup task.
     *
     * @var array
     */
    public $schedule;

    /**
     * The storage configuration of the backup task.
     *
     * @var array
     */
    public $storage;

    /**
     * The status of the backup task.
     *
     * @var string
     */
    public $status;

    /**
     * Whether the backup task has isolated credentials.
     *
     * @var bool
     */
    public $hasIsolatedCredentials;

    /**
     * The date/time the backup task was created.
     *
     * @var string
     */
    public $createdAt;

    /**
     * The date/time the backup task was last updated.
     *
     * @var string
     */
    public $updatedAt;

    /**
     * Update the given backup task.
     *
     * @param array $data
     * @return \VanguardBackup\Vanguard\Resources\BackupTask
     */
    public function update(array $data)
    {
        return $this->client->updateBackupTask($this->id, $data);
    }

    /**
     * Delete the given backup task.
     *
     * @return void
     */
    public function delete()
    {
        $this->client->deleteBackupTask($this->id);
    }

    /**
     * Get the status of the backup task.
     *
     * @return array
     */
    public function getStatus(): array
    {
        return $this->client->getBackupTaskStatus($this->id);
    }

    /**
     * Get the latest log for the backup task.
     *
     * @return array
     */
    public function getLatestLog(): array
    {
        return $this->client->getLatestBackupTaskLog($this->id);
    }

    /**
     * Run the backup task.
     *
     * @return array
     */
    public function run(): array
    {
        return $this->client->runBackupTask($this->id);
    }

    /**
     * Check if the backup task is for a database.
     *
     * @return bool
     */
    public function isDatabaseBackup(): bool
    {
        return $this->source['type'] === 'database';
    }

    /**
     * Check if the backup task is for files.
     *
     * @return bool
     */
    public function isFileBackup(): bool
    {
        return $this->source['type'] === 'files';
    }

    /**
     * Get the frequency of the backup task.
     *
     * @return string
     */
    public function getFrequency(): string
    {
        return $this->schedule['frequency'];
    }

    /**
     * Get the time the backup task is scheduled to run.
     *
     * @return string
     */
    public function getScheduledTime(): string
    {
        return $this->schedule['time'];
    }
}