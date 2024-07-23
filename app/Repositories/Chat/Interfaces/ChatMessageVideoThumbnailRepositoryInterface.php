<?php

namespace App\Repositories\Chat\Interfaces;

use App\Models\MySql\Chat\ChatMessageVideo;
use App\Models\MySql\Chat\ChatMessageVideoThumbnail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface ChatMessageVideoThumbnailRepositoryInterface
 *
 * @package App\Repositories\Chat\Interfaces
 */
interface ChatMessageVideoThumbnailRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return ChatMessageVideoThumbnail|null
     */
    public function findById(
        int $id
    ) : ?ChatMessageVideoThumbnail;

    /**
     * This method provides getting all rows
     * with an eloquent model
     *
     * @return Collection
     */
    public function getAll() : Collection;

    /**
     * This method provides getting all rows
     * with an eloquent model with pagination
     *
     * @param int|null $page
     *
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(
        ?int $page
    ) : LengthAwarePaginator;

    /**
     * This method provides getting rows
     * with an eloquent model by certain query
     *
     * @param array $ids
     *
     * @return Collection
     */
    public function getByIds(
        array $ids
    ) : Collection;

    /**
     * This method provides creating a new row
     * with an eloquent models
     *
     * @param ChatMessageVideo $chatMessageVideo
     * @param string $url
     * @param string $mime
     *
     * @return ChatMessageVideoThumbnail|null
     */
    public function store(
        ChatMessageVideo $chatMessageVideo,
        string $url,
        string $mime
    ) : ?ChatMessageVideoThumbnail;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param ChatMessageVideoThumbnail $chatMessageVideoThumbnail
     * @param ChatMessageVideo|null $chatMessageVideo
     * @param string|null $url
     * @param string|null $mime
     *
     * @return ChatMessageVideoThumbnail
     */
    public function update(
        ChatMessageVideoThumbnail $chatMessageVideoThumbnail,
        ?ChatMessageVideo $chatMessageVideo,
        ?string $url,
        ?string $mime
    ) : ChatMessageVideoThumbnail;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param ChatMessageVideoThumbnail $chatMessageVideoThumbnail
     *
     * @return bool
     */
    public function delete(
        ChatMessageVideoThumbnail $chatMessageVideoThumbnail
    ) : bool;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param array $chatMessageVideosIds
     *
     * @return bool
     */
    public function deleteByVideosIds(
        array $chatMessageVideosIds
    ) : bool;

    /**
     * This method provides deleting existing rows
     * with an eloquent model
     *
     * @param array $ids
     *
     * @return bool
     */
    public function deleteByIds(
        array $ids
    ) : bool;
}
