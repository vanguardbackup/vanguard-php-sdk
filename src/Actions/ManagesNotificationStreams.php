<?php

namespace VanguardBackup\Vanguard\Actions;

use VanguardBackup\Vanguard\Resources\NotificationStream;

trait ManagesNotificationStreams
{
    /**
     * Get the collection of notification streams.
     *
     * @return NotificationStream[]
     */
    public function notificationStreams()
    {
        return $this->transformCollection(
            $this->get('notification-streams')['data'], NotificationStream::class
        );
    }

    /**
     * Get a notification stream instance.
     *
     * @param string $streamId
     * @return NotificationStream
     */
    public function notificationStream(string $streamId): NotificationStream
    {
        return new NotificationStream($this->get("notification-streams/{$streamId}")['data'], $this);
    }

    /**
     * Create a new notification stream.
     *
     * @param array $data
     * @return NotificationStream
     */
    public function createNotificationStream(array $data): NotificationStream
    {
        return new NotificationStream($this->post('notification-streams', $data)['data'], $this);
    }

    /**
     * Update the given notification stream.
     *
     * @param string $streamId
     * @param array $data
     * @return NotificationStream
     */
    public function updateNotificationStream(string $streamId, array $data): NotificationStream
    {
        return new NotificationStream($this->put("notification-streams/{$streamId}", $data)['data'], $this);
    }

    /**
     * Delete the given notification stream.
     *
     * @param string $streamId
     * @return void
     */
    public function deleteNotificationStream(string $streamId): void
    {
        $this->delete("notification-streams/{$streamId}");
    }
}