<?php

declare(strict_types=1);

namespace VanguardBackup\Vanguard\Resources;

class ScheduledBackupTask extends Resource
{
    /**
     * The backup task ID.
     */
    public string $backupTaskId;

    /**
     * The backup task label.
     */
    public string $label;

    /**
     * The type of backup task.
     */
    public string $type;

    /**
     * The next run date and time in ISO 8601 format.
     */
    public ?string $nextRun;

    /**
     * The next run date and time in human-readable format.
     */
    public ?string $nextRunHuman;

    /**
     * Create a new resource instance.
     *
     * @param  \VanguardBackup\Vanguard\VanguardClient|null  $vanguard
     */
    public function __construct(array $attributes, $vanguard = null)
    {
        parent::__construct($attributes, $vanguard);

        $this->backupTaskId = $attributes['backup_task_id'];
        $this->label = $attributes['label'];
        $this->type = $attributes['type'];
        $this->nextRun = $attributes['next_run'];
        $this->nextRunHuman = $attributes['next_run_human'];
    }
}
