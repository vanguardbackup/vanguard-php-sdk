<?php

namespace VanguardBackup\Vanguard\Actions;

use VanguardBackup\Vanguard\Resources\BackupDestination;

trait ManagesBackupDestinations
{
    /**
     * Get the collection of backup destinations.
     *
     * @return BackupDestination[]
     */
    public function backupDestinations()
    {
        return $this->transformCollection(
            $this->get('backup-destinations')['data'], BackupDestination::class
        );
    }

    /**
     * Get a backup destination instance.
     *
     * @param string $destinationId
     * @return BackupDestination
     */
    public function backupDestination(string $destinationId): BackupDestination
    {
        return new BackupDestination($this->get("backup-destinations/{$destinationId}")['data'], $this);
    }

    /**
     * Create a new backup destination.
     *
     * @param array $data
     * @return BackupDestination
     */
    public function createBackupDestination(array $data): BackupDestination
    {
        return new BackupDestination($this->post('backup-destinations', $data)['data'], $this);
    }

    /**
     * Update the given backup destination.
     *
     * @param string $destinationId
     * @param array $data
     * @return BackupDestination
     */
    public function updateBackupDestination(string $destinationId, array $data): BackupDestination
    {
        return new BackupDestination($this->put("backup-destinations/{$destinationId}", $data)['data'], $this);
    }

    /**
     * Delete the given backup destination.
     *
     * @param string $destinationId
     * @return void
     */
    public function deleteBackupDestination(string $destinationId): void
    {
        $this->delete("backup-destinations/{$destinationId}");
    }
}