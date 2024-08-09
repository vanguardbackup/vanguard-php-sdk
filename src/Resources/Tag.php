<?php

namespace VanguardBackup\Vanguard\Resources;

class Tag extends Resource
{
    /**
     * The id of the tag.
     *
     * @var int
     */
    public int $id;

    /**
     * The user id associated with the tag.
     *
     * @var int
     */
    public int $userId;

    /**
     * The label of the tag.
     *
     * @var string
     */
    public string $label;

    /**
     * The description of the tag.
     *
     * @var string|null
     */
    public ?string $description;

    /**
     * The date/time the tag was created.
     *
     * @var string
     */
    public string $createdAt;

    /**
     * The date/time the tag was last updated.
     *
     * @var string
     */
    public string $updatedAt;

    /**
     * Update the given tag.
     *
     * @param array $data
     * @return Tag
     */
    public function update(array $data): Tag
    {
        return $this->client->updateTag($this->id, $data);
    }

    /**
     * Delete the given tag.
     *
     * @return void
     */
    public function delete(): void
    {
        $this->client->deleteTag($this->id);
    }
}