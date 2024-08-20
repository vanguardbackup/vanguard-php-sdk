<?php

declare(strict_types=1);

namespace VanguardBackup\Vanguard\Actions;

use VanguardBackup\Vanguard\Resources\BackupTaskLog;

trait ManagesBackupTaskLogs
{
    /**
     * Get the collection of backup task logs.
     *
     * @return BackupTaskLog[]
     *
     * @throws \Exception
     */
    public function backupTaskLogs(array $query = []): array
    {
        return $this->transformCollection(
            $this->get('backup-task-logs', $query)['data'], BackupTaskLog::class
        );
    }

    /**
     * Get a backup task log instance.
     */
    public function backupTaskLog(int $logId): BackupTaskLog
    {
        return new BackupTaskLog($this->get("backup-task-logs/{$logId}")['data'], $this);
    }

    /**
     * Delete the given backup task log.
     */
    public function deleteBackupTaskLog(int $logId): void
    {
        $this->delete("backup-task-logs/{$logId}");
    }
}
