<?php

declare(strict_types=1);

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
     */
    public function backupDestination(string $destinationId): BackupDestination
    {
        return new BackupDestination($this->get("backup-destinations/{$destinationId}")['data'], $this);
    }

    /**
     * Create a new backup destination.
     */
    public function createBackupDestination(array $data): BackupDestination
    {
        return new BackupDestination($this->post('backup-destinations', $data)['data'], $this);
    }

    /**
     * Update the given backup destination.
     */
    public function updateBackupDestination(string $destinationId, array $data): BackupDestination
    {
        return new BackupDestination($this->put("backup-destinations/{$destinationId}", $data)['data'], $this);
    }

    /**
     * Delete the given backup destination.
     */
    public function deleteBackupDestination(string $destinationId): void
    {
        $this->delete("backup-destinations/{$destinationId}");
    }
}
