<p align="center"><img src="https://raw.githubusercontent.com/vanguardbackup/assets/main/icon-200.png" width="120" alt="Vanguard Logo"></p>

<p align="center">
  <a href="https://opensource.org/license/mit">
    <img src="https://img.shields.io/github/license/vanguardbackup/vanguard-php-sdk?style=for-the-badge&logo=opensourceinitiative&logoColor=ffffff" alt="License: MIT">
  </a>
  <a href="https://github.com/vanguardbackup/vanguard-php-sdk/actions/workflows/tests.yml">
    <img src="https://img.shields.io/github/actions/workflow/status/vanguardbackup/vanguard-php-sdk/tests.yml?style=for-the-badge&logo=githubactions&logoColor=ffffff&label=Tests" alt="Tests">
  </a>
<a href="https://github.com/vanguardbackup/vanguard-php-sdk/releases">
  <img src="https://img.shields.io/github/v/release/vanguardbackup/vanguard-php-sdk?style=for-the-badge&logo=github&logoColor=ffffff" alt="GitHub Release">
</a>
<a href="https://packagist.org/packages/vanguardbackup/vanguard-php-sdk">
<img alt="Packagist Downloads" src="https://img.shields.io/packagist/dt/vanguardbackup/vanguard-php-sdk?style=for-the-badge&logo=packagist&logoColor=ffffff&logoSize=auto&label=Downloads">
</a>


</p>

# Vanguard PHP SDK

## Overview

The Vanguard PHP SDK provides a fluent interface for interacting with Vanguard's API, enabling efficient management of your backup operations.

## API Documentation

For comprehensive API documentation, including request/response schemas and example payloads, please refer to our official API documentation:

[Vanguard API Documentation](https://docs.vanguardbackup.com/api/introduction)

This resource is invaluable when constructing requests or handling responses, especially for complex operations not fully abstracted by the SDK.

## Getting Started

### Installation

Add the Vanguard PHP SDK to your project using Composer:

```bash
composer require vanguardbackup/vanguard-php-sdk
```

### Initializing the SDK

Create a new instance of the VanguardBackup client:

```php
$vanguard = new VanguardBackup\Vanguard\VanguardClient('YOUR_API_KEY');
```

For custom Vanguard installations, specify the API base URL:

```php
$vanguard = new VanguardBackup\Vanguard\VanguardClient('YOUR_API_KEY', 'https://your-vanguard-instance.com');
```

## Core Functionalities

### User Authentication

Retrieve the authenticated user's information:

```php
$user = $vanguard->user();
```

### Backup Task Management

Manage your backup tasks:

```php
// List all backup tasks
$tasks = $vanguard->backupTasks();

// Get a specific backup task
$task = $vanguard->backupTask($taskId);

// Create a new backup task
$newTask = $vanguard->createBackupTask([
    'label' => 'Daily Database Backup',
    'source_type' => 'database',
    // ... other task parameters
]);

// Update an existing backup task
$updatedTask = $vanguard->updateBackupTask($taskId, [
    'frequency' => 'daily',
    // ... other parameters to update
]);

// Delete a backup task
$vanguard->deleteBackupTask($taskId);

// Get the status of a backup task
$status = $vanguard->getBackupTaskStatus($taskId);

// Retrieve the latest log for a backup task
$log = $vanguard->getLatestBackupTaskLog($taskId);

// Manually trigger a backup task
$vanguard->runBackupTask($taskId);
```

Individual `BackupTask` instances also provide methods for common operations:

```php
$task->update(['label' => 'Weekly Full Backup']);
$task->delete();
$task->getStatus();
$task->getLatestLog();
$task->run();
```

### Backup Task Log Management

Manage logs for your backup tasks:

```php
// List all backup task logs
$logs = $vanguard->backupTaskLogs();

// Get a specific backup task log
$log = $vanguard->backupTaskLog($logId);

// Delete a backup task log
$vanguard->deleteBackupTaskLog($logId);
```

Individual `BackupTaskLog` instances also provide methods for common operations:

```php
$log->delete();
$log->isSuccessful();
$log->isFailed();
```

### Remote Server Management

Manage the servers from which you're backing up data:

```php
// List all remote servers
$servers = $vanguard->remoteServers();

// Get a specific remote server
$server = $vanguard->remoteServer($serverId);

// Add a new remote server
$newServer = $vanguard->createRemoteServer([
    'label' => 'Production DB Server',
    'ip_address' => '192.168.1.100',
    // ... other server details
]);

// Update a remote server
$updatedServer = $vanguard->updateRemoteServer($serverId, [
    'label' => 'Updated Production DB Server',
]);

// Remove a remote server
$vanguard->deleteRemoteServer($serverId);
```

### Backup Destination Management

Control where your backups are stored:

```php
// List all backup destinations
$destinations = $vanguard->backupDestinations();

// Get a specific backup destination
$destination = $vanguard->backupDestination($destinationId);

// Create a new backup destination
$newDestination = $vanguard->createBackupDestination([
    'type' => 's3',
    'bucket' => 'my-backups',
    // ... other destination details
]);

// Update a backup destination
$updatedDestination = $vanguard->updateBackupDestination($destinationId, [
    'bucket' => 'new-backup-bucket',
]);

// Remove a backup destination
$vanguard->deleteBackupDestination($destinationId);
```

### Tag Management

Organize your backup resources with tags:

```php
// List all tags
$tags = $vanguard->tags();

// Get a specific tag
$tag = $vanguard->tag($tagId);

// Create a new tag
$newTag = $vanguard->createTag(['label' => 'Production']);

// Update a tag
$updatedTag = $vanguard->updateTag($tagId, ['label' => 'Staging']);

// Delete a tag
$vanguard->deleteTag($tagId);
```

### Notification Stream Management

Configure how you receive alerts about your backups:

```php
// List all notification streams
$streams = $vanguard->notificationStreams();

// Get a specific notification stream
$stream = $vanguard->notificationStream($streamId);

// Create a new notification stream
$newStream = $vanguard->createNotificationStream([
    'type' => 'slack',
    'webhook_url' => 'https://hooks.slack.com/services/...',
]);

// Update a notification stream
$updatedStream = $vanguard->updateNotificationStream($streamId, [
    'events' => ['backup_failed', 'backup_successful'],
]);

// Delete a notification stream
$vanguard->deleteNotificationStream($streamId);
```

## Security

For reporting security vulnerabilities, please refer to our [security policy](https://github.com/vanguardbackup/vanguard/security/policy).

## License

The Vanguard PHP SDK is open-source software, released under the [MIT licence](LICENSE.md).

## Acknowledgments

We'd like to express our gratitude to the Laravel Forge PHP SDK, which served as an inspiration for the structure and design of this SDK.