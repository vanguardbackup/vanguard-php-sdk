<?php

declare(strict_types=1);

namespace VanguardBackup\Vanguard\Resources;

class BackupTaskLog extends Resource
{
    /**
     * The id of the backup task log.
     *
     * @var int
     */
    public $id;

    /**
     * The id of the associated backup task.
     *
     * @var int
     */
    public $backupTaskId;

    /**
     * The output of the backup task.
     *
     * @var string
     */
    public $output;

    /**
     * The date/time the backup task finished.
     *
     * @var string|null
     */
    public $finishedAt;

    /**
     * The status of the backup task.
     *
     * @var string
     */
    public $status;

    /**
     * The date/time the backup task log was created.
     *
     * @var string
     */
    public $createdAt;

    /**
     * Delete the given backup task log.
     *
     * @return void
     */
    public function delete(): void
    {
        $this->client->deleteBackupTaskLog($this->id);
    }

    /**
     * Check if the backup task was successful.
     *
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return $this->status === 'successful';
    }

    /**
     * Check if the backup task failed.
     *
     * @return bool
     */
    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }
}