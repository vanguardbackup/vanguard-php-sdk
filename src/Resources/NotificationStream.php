<?php

declare(strict_types=1);

namespace VanguardBackup\Vanguard\Resources;

class NotificationStream extends Resource
{
    /**
     * The id of the notification stream.
     */
    public int $id;

    /**
     * The user id associated with the notification stream.
     */
    public int $userId;

    /**
     * The label of the notification stream.
     */
    public string $label;

    /**
     * The type of the notification stream.
     */
    public string $type;

    /**
     * The notification settings.
     */
    public array $notifications;

    /**
     * The date/time the notification stream was created.
     */
    public string $createdAt;

    /**
     * The date/time the notification stream was last updated.
     */
    public string $updatedAt;

    /**
     * Update the given notification stream.
     */
    public function update(array $data): NotificationStream
    {
        return $this->client->updateNotificationStream($this->id, $data);
    }

    /**
     * Delete the given notification stream.
     */
    public function delete(): void
    {
        $this->client->deleteNotificationStream($this->id);
    }

    /**
     * Check if the notification stream sends notifications on successful backups.
     */
    public function notifiesOnSuccess(): bool
    {
        return $this->notifications['on_success'] ?? false;
    }

    /**
     * Check if the notification stream sends notifications on failed backups.
     */
    public function notifiesOnFailure(): bool
    {
        return $this->notifications['on_failure'] ?? false;
    }
}
