<?php

namespace VanguardBackup\Vanguard\Actions;

use VanguardBackup\Vanguard\Resources\BackupTask;

trait ManagesBackupTasks
{
    /**
     * Get the collection of backup tasks.
     *
     * @return BackupTask[]
     */
    public function backupTasks()
    {
        return $this->transformCollection(
            $this->get('backup-tasks')['data'], BackupTask::class
        );
    }

    /**
     * Get a backup task instance.
     *
     * @param string $taskId
     * @return BackupTask
     */
    public function backupTask(string $taskId): BackupTask
    {
        return new BackupTask($this->get("backup-tasks/{$taskId}")['data'], $this);
    }

    /**
     * Create a new backup task.
     *
     * @param array $data
     * @return BackupTask
     */
    public function createBackupTask(array $data): BackupTask
    {
        return new BackupTask($this->post('backup-tasks', $data)['data'], $this);
    }

    /**
     * Update the given backup task.
     *
     * @param string $taskId
     * @param array $data
     * @return BackupTask
     */
    public function updateBackupTask(string $taskId, array $data): BackupTask
    {
        return new BackupTask($this->put("backup-tasks/{$taskId}", $data)['data'], $this);
    }

    /**
     * Delete the given backup task.
     *
     * @param string $taskId
     * @return void
     */
    public function deleteBackupTask(string $taskId): void
    {
        $this->delete("backup-tasks/{$taskId}");
    }

    /**
     * Get the status of a backup task.
     *
     * @param string $taskId
     * @return array
     */
    public function getBackupTaskStatus(string $taskId): array
    {
        return $this->get("backup-tasks/{$taskId}/status")['data'];
    }

    /**
     * Get the latest log for a backup task.
     *
     * @param string $taskId
     * @return array
     */
    public function getLatestBackupTaskLog(string $taskId): array
    {
        return $this->get("backup-tasks/{$taskId}/latest-log")['data'];
    }

    /**
     * Run a backup task.
     *
     * @param string $taskId
     * @return array
     */
    public function runBackupTask(string $taskId): array
    {
        return $this->post("backup-tasks/{$taskId}/run");
    }
}