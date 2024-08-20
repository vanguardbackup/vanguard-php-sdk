<?php

declare(strict_types=1);

namespace VanguardBackup\Vanguard\Actions;

use Exception;
use VanguardBackup\Vanguard\Resources\BackupTask;

trait ManagesBackupTasks
{
    /**
     * Get the collection of backup tasks.
     *
     * @return BackupTask[]
     *
     * @throws Exception
     */
    public function backupTasks(): array
    {
        return $this->transformCollection(
            $this->get('backup-tasks')['data'], BackupTask::class
        );
    }

    /**
     * Get a backup task instance.
     */
    public function backupTask(string $taskId): BackupTask
    {
        return new BackupTask($this->get("backup-tasks/{$taskId}")['data'], $this);
    }

    /**
     * Create a new backup task.
     */
    public function createBackupTask(array $data): BackupTask
    {
        return new BackupTask($this->post('backup-tasks', $data)['data'], $this);
    }

    /**
     * Update the given backup task.
     */
    public function updateBackupTask(string $taskId, array $data): BackupTask
    {
        return new BackupTask($this->put("backup-tasks/{$taskId}", $data)['data'], $this);
    }

    /**
     * Delete the given backup task.
     */
    public function deleteBackupTask(string $taskId): void
    {
        $this->delete("backup-tasks/{$taskId}");
    }

    /**
     * Get the status of a backup task.
     */
    public function getBackupTaskStatus(string $taskId): array
    {
        return $this->get("backup-tasks/{$taskId}/status")['data'];
    }

    /**
     * Get the latest log for a backup task.
     */
    public function getLatestBackupTaskLog(string $taskId): array
    {
        return $this->get("backup-tasks/{$taskId}/latest-log")['data'];
    }

    /**
     * Run a backup task.
     */
    public function runBackupTask(string $taskId): array
    {
        return $this->post("backup-tasks/{$taskId}/run");
    }
}
