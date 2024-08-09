<?php

namespace VanguardBackup\Vanguard\Resources;

class BackupDestination extends Resource
{
    /**
     * The id of the backup destination.
     *
     * @var int
     */
    public $id;

    /**
     * The user id associated with the backup destination.
     *
     * @var int
     */
    public $userId;

    /**
     * The label of the backup destination.
     *
     * @var string
     */
    public $label;

    /**
     * The type of the backup destination.
     *
     * @var string
     */
    public $type;

    /**
     * The S3 bucket name.
     *
     * @var string|null
     */
    public $s3BucketName;

    /**
     * Whether to use path-style endpoint.
     *
     * @var bool|null
     */
    public $pathStyleEndpoint;

    /**
     * The S3 region.
     *
     * @var string|null
     */
    public $s3Region;

    /**
     * The custom S3 endpoint.
     *
     * @var string|null
     */
    public $s3Endpoint;

    /**
     * The date/time the backup destination was created.
     *
     * @var string
     */
    public $createdAt;

    /**
     * The date/time the backup destination was last updated.
     *
     * @var string
     */
    public $updatedAt;

    /**
     * Update the given backup destination.
     *
     * @param array $data
     * @return \VanguardBackup\Vanguard\Resources\BackupDestination
     */
    public function update(array $data)
    {
        return $this->client->updateBackupDestination($this->id, $data);
    }

    /**
     * Delete the given backup destination.
     *
     * @return void
     */
    public function delete()
    {
        $this->client->deleteBackupDestination($this->id);
    }

    /**
     * Check if the backup destination is of type S3.
     *
     * @return bool
     */
    public function isS3(): bool
    {
        return $this->type === 's3';
    }

    /**
     * Check if the backup destination is of type custom S3.
     *
     * @return bool
     */
    public function isCustomS3(): bool
    {
        return $this->type === 'custom_s3';
    }

    /**
     * Get the S3 endpoint URL.
     *
     * @return string|null
     */
    public function getS3EndpointUrl(): ?string
    {
        if ($this->isCustomS3()) {
            return $this->s3Endpoint;
        }

        if ($this->isS3() && $this->s3Region) {
            return "https://s3.{$this->s3Region}.amazonaws.com";
        }

        return null;
    }
}