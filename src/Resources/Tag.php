<?php

declare(strict_types=1);

namespace VanguardBackup\Vanguard\Resources;

class Tag extends Resource
{
    /**
     * The id of the tag.
     */
    public int $id;

    /**
     * The user id associated with the tag.
     */
    public int $userId;

    /**
     * The label of the tag.
     */
    public string $label;

    /**
     * The description of the tag.
     */
    public ?string $description;

    /**
     * The date/time the tag was created.
     */
    public string $createdAt;

    /**
     * The date/time the tag was last updated.
     */
    public string $updatedAt;

    /**
     * Update the given tag.
     */
    public function update(array $data): Tag
    {
        return $this->client->updateTag($this->id, $data);
    }

    /**
     * Delete the given tag.
     */
    public function delete(): void
    {
        $this->client->deleteTag($this->id);
    }
}
