<?php

declare(strict_types=1);

namespace VanguardBackup\Vanguard\Resources;

use VanguardBackup\Vanguard\VanguardClient;

class User extends Resource
{
    /**
     * The id of the user.
     *
     * @var int
     */
    public mixed $id;

    /**
     * The full name of the user.
     *
     * @var string
     */
    public mixed $name;

    /**
     * The first name of the user.
     *
     * @var string
     */
    public mixed $firstName;

    /**
     * The last name of the user.
     *
     * @var string
     */
    public mixed $lastName;

    /**
     * The email address of the user.
     *
     * @var string
     */
    public mixed $email;

    /**
     * The URL of the user's avatar.
     *
     * @var string
     */
    public mixed $avatarUrl;

    /**
     * The user's preferred timezone.
     *
     * @var string
     */
    public mixed $timezone;

    /**
     * The user's preferred language.
     *
     * @var string
     */
    public mixed $language;

    /**
     * Determines if the user is an admin.
     *
     * @var bool
     */
    public mixed $isAdmin;

    /**
     * Determines if GitHub login is enabled for the user.
     *
     * @var bool
     */
    public mixed $githubLoginEnabled;

    /**
     * Determines if weekly summary is enabled for the user.
     *
     * @var bool
     */
    public mixed $weeklySummaryEnabled;

    /**
     * Total number of backup tasks.
     *
     * @var int
     */
    public mixed $totalBackupTasks;

    /**
     * Number of active backup tasks.
     *
     * @var int
     */
    public mixed $activeBackupTasks;

    /**
     * Total number of backup logs.
     *
     * @var int
     */
    public mixed $totalBackupLogs;

    /**
     * Number of backup logs for today.
     *
     * @var int
     */
    public mixed $todayBackupLogs;

    /**
     * Number of remote servers.
     *
     * @var int
     */
    public mixed $remoteServers;

    /**
     * Number of backup destinations.
     *
     * @var int
     */
    public mixed $backupDestinations;

    /**
     * Number of tags.
     *
     * @var int
     */
    public mixed $tags;

    /**
     * Number of notification streams.
     *
     * @var int
     */
    public mixed $notificationStreams;

    /**
     * The timestamp when the account was created.
     *
     * @var string
     */
    public mixed $accountCreated;

    /**
     * Create a new User instance.
     *
     * @param  VanguardClient|null  $vanguard
     * @return void
     */
    public function __construct(array $attributes, $vanguard = null)
    {
        parent::__construct($attributes, $vanguard);

        $this->id = $attributes['id'];
        $this->name = $attributes['personal_info']['name'];
        $this->firstName = $attributes['personal_info']['first_name'];
        $this->lastName = $attributes['personal_info']['last_name'];
        $this->email = $attributes['personal_info']['email'];
        $this->avatarUrl = $attributes['personal_info']['avatar_url'];
        $this->timezone = $attributes['account_settings']['timezone'];
        $this->language = $attributes['account_settings']['language'];
        $this->isAdmin = $attributes['account_settings']['is_admin'];
        $this->githubLoginEnabled = $attributes['account_settings']['github_login_enabled'];
        $this->weeklySummaryEnabled = $attributes['account_settings']['weekly_summary_enabled'];
        $this->totalBackupTasks = $attributes['backup_tasks']['total'];
        $this->activeBackupTasks = $attributes['backup_tasks']['active'];
        $this->totalBackupLogs = $attributes['backup_tasks']['logs']['total'];
        $this->todayBackupLogs = $attributes['backup_tasks']['logs']['today'];
        $this->remoteServers = $attributes['related_entities']['remote_servers'];
        $this->backupDestinations = $attributes['related_entities']['backup_destinations'];
        $this->tags = $attributes['related_entities']['tags'];
        $this->notificationStreams = $attributes['related_entities']['notification_streams'];
        $this->accountCreated = $attributes['timestamps']['account_created'];
    }
}
