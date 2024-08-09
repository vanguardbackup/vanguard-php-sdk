<?php

namespace VanguardBackup\Vanguard\Resources;

class NotificationStream extends Resource
{
    /**
     * The id of the notification stream.
     *
     * @var int
     */
    public int $id;

    /**
     * The user id associated with the notification stream.
     *
     * @var int
     */
    public int $userId;

    /**
     * The label of the notification stream.
     *
     * @var string
     */
    public string $label;

    /**
     * The type of the notification stream.
     *
     * @var string
     */
    public string $type;

    /**
     * The notification settings.
     *
     * @var array
     */
    public array $notifications;

    /**
     * The date/time the notification stream was created.
     *
     * @var string
     */
    public string $createdAt;

    /**
     * The date/time the notification stream was last updated.
     *
     * @var string
     */
    public string $updatedAt;

    /**
     * Update the given notification stream.
     *
     * @param array $data
     * @return NotificationStream
     */
    public function update(array $data): NotificationStream
    {
        return $this->client->updateNotificationStream($this->id, $data);
    }

    /**
     * Delete the given notification stream.
     *
     * @return void
     */
    public function delete(): void
    {
        $this->client->deleteNotificationStream($this->id);
    }

    /**
     * Check if the notification stream sends notifications on successful backups.
     *
     * @return bool
     */
    public function notifiesOnSuccess(): bool
    {
        return $this->notifications['on_success'] ?? false;
    }

    /**
     * Check if the notification stream sends notifications on failed backups.
     *
     * @return bool
     */
    public function notifiesOnFailure(): bool
    {
        return $this->notifications['on_failure'] ?? false;
    }
}