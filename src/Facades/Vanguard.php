<?php

declare(strict_types=1);

namespace VanguardBackup\Vanguard\Facades;

use Illuminate\Support\Facades\Facade;
use VanguardBackup\Vanguard\VanguardManager;

/**
 * @method static \VanguardBackup\Vanguard\VanguardClient setApiKey(string $apiKey, \GuzzleHttp\Client|null $httpClient = null)
 * @method static \VanguardBackup\Vanguard\VanguardClient setBaseUrl(string $url)
 * @method static string getBaseUrl()
 * @method static \VanguardBackup\Vanguard\Resources\User user()
 * @method static \VanguardBackup\Vanguard\Resources\Tag[] tags()
 * @method static \VanguardBackup\Vanguard\Resources\Tag tag(string $tagId)
 * @method static \VanguardBackup\Vanguard\Resources\Tag createTag(array $data)
 * @method static \VanguardBackup\Vanguard\Resources\Tag updateTag(string $tagId, array $data)
 * @method static void deleteTag(string $tagId)
 * @method static \VanguardBackup\Vanguard\Resources\NotificationStream[] notificationStreams()
 * @method static \VanguardBackup\Vanguard\Resources\NotificationStream notificationStream(string $streamId)
 * @method static \VanguardBackup\Vanguard\Resources\NotificationStream createNotificationStream(array $data)
 * @method static \VanguardBackup\Vanguard\Resources\NotificationStream updateNotificationStream(string $streamId, array $data)
 * @method static void deleteNotificationStream(string $streamId)
 * @method static \VanguardBackup\Vanguard\Resources\RemoteServer[] remoteServers()
 * @method static \VanguardBackup\Vanguard\Resources\RemoteServer remoteServer(string $serverId)
 * @method static \VanguardBackup\Vanguard\Resources\RemoteServer createRemoteServer(array $data)
 * @method static \VanguardBackup\Vanguard\Resources\RemoteServer updateRemoteServer(string $serverId, array $data)
 * @method static void deleteRemoteServer(string $serverId)
 * @method static \VanguardBackup\Vanguard\Resources\BackupDestination[] backupDestinations()
 * @method static \VanguardBackup\Vanguard\Resources\BackupDestination backupDestination(string $destinationId)
 * @method static \VanguardBackup\Vanguard\Resources\BackupDestination createBackupDestination(array $data)
 * @method static \VanguardBackup\Vanguard\Resources\BackupDestination updateBackupDestination(string $destinationId, array $data)
 * @method static void deleteBackupDestination(string $destinationId)
 * @method static \VanguardBackup\Vanguard\Resources\BackupTask[] backupTasks()
 * @method static \VanguardBackup\Vanguard\Resources\BackupTask backupTask(string $taskId)
 * @method static \VanguardBackup\Vanguard\Resources\BackupTask createBackupTask(array $data)
 * @method static \VanguardBackup\Vanguard\Resources\BackupTask updateBackupTask(string $taskId, array $data)
 * @method static void deleteBackupTask(string $taskId)
 * @method static array getBackupTaskStatus(string $taskId)
 * @method static array getLatestBackupTaskLog(string $taskId)
 * @method static array runBackupTask(string $taskId)
 * @method static mixed get(string $uri)
 * @method static mixed post(string $uri, array $payload = [])
 * @method static mixed put(string $uri, array $payload = [])
 * @method static mixed delete(string $uri, array $payload = [])
 *
 * @see \VanguardBackup\Vanguard\VanguardClient
 */
class Vanguard extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return VanguardManager::class;
    }
}
