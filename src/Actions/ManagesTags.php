<?php

namespace VanguardBackup\Vanguard\Actions;

use VanguardBackup\Vanguard\Resources\Tag;

trait ManagesTags
{
    /**
     * Get the collection of tags.
     *
     * @return Tag[]
     */
    public function tags()
    {
        return $this->transformCollection(
            $this->get('tags')['tags'], Tag::class
        );
    }

    /**
     * Get a tag instance.
     *
     * @param string $tagId
     * @return Tag
     */
    public function tag(string $tagId): Tag
    {
        return new Tag($this->get("tags/{$tagId}")['tag'], $this);
    }

    /**
     * Create a new tag.
     *
     * @param array $data
     * @return Tag
     */
    public function createTag(array $data): Tag
    {
        return new Tag($this->post('tags', $data)['tag'], $this);
    }

    /**
     * Update the given tag.
     *
     * @param string $tagId
     * @param array $data
     * @return Tag
     */
    public function updateTag(string $tagId, array $data): Tag
    {
        return new Tag($this->put("tags/{$tagId}", $data)['tag'], $this);
    }

    /**
     * Delete the given tag.
     *
     * @param string $tagId
     * @return void
     */
    public function deleteTag(string $tagId): void
    {
        $this->delete("tags/{$tagId}");
    }
}