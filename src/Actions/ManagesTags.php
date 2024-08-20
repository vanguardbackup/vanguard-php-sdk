<?php

declare(strict_types=1);

namespace VanguardBackup\Vanguard\Actions;

use Exception;
use VanguardBackup\Vanguard\Resources\Tag;

trait ManagesTags
{
    /**
     * Get the collection of tags.
     *
     * @return Tag[]
     * @throws Exception
     */
    public function tags(): array
    {
        return $this->transformCollection(
            $this->get('tags')['tags'], Tag::class
        );
    }

    /**
     * Get a tag instance.
     */
    public function tag(string $tagId): Tag
    {
        return new Tag($this->get("tags/{$tagId}")['tag'], $this);
    }

    /**
     * Create a new tag.
     */
    public function createTag(array $data): Tag
    {
        return new Tag($this->post('tags', $data)['tag'], $this);
    }

    /**
     * Update the given tag.
     */
    public function updateTag(string $tagId, array $data): Tag
    {
        return new Tag($this->put("tags/{$tagId}", $data)['tag'], $this);
    }

    /**
     * Delete the given tag.
     */
    public function deleteTag(string $tagId): void
    {
        $this->delete("tags/{$tagId}");
    }
}
