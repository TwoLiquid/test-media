<?php

namespace App\Repositories\Review\Interfaces;

use App\Models\MySql\Review\ReviewMessageVideo;
use App\Models\MySql\Review\ReviewMessageVideoThumbnail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface ReviewMessageVideoThumbnailRepositoryInterface
 *
 * @package App\Repositories\Review\Interfaces
 */
interface ReviewMessageVideoThumbnailRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return ReviewMessageVideoThumbnail|null
     */
    public function findById(
        int $id
    ) : ?ReviewMessageVideoThumbnail;

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
     * with an eloquent model
     *
     * @param ReviewMessageVideo $reviewMessageVideo
     * @param string $url
     * @param string $mime
     *
     * @return ReviewMessageVideoThumbnail|null
     */
    public function store(
        ReviewMessageVideo $reviewMessageVideo,
        string $url,
        string $mime
    ) : ?ReviewMessageVideoThumbnail;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param ReviewMessageVideoThumbnail $reviewMessageVideoThumbnail
     * @param ReviewMessageVideo|null $reviewMessageVideo
     * @param string|null $url
     * @param string|null $mime
     *
     * @return ReviewMessageVideoThumbnail
     */
    public function update(
        ReviewMessageVideoThumbnail $reviewMessageVideoThumbnail,
        ?ReviewMessageVideo $reviewMessageVideo,
        ?string $url,
        ?string $mime
    ) : ReviewMessageVideoThumbnail;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param ReviewMessageVideoThumbnail $reviewMessageVideoThumbnail
     *
     * @return bool
     */
    public function delete(
        ReviewMessageVideoThumbnail $reviewMessageVideoThumbnail
    ) : bool;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param array $videosIds
     *
     * @return bool
     */
    public function deleteByVideosIds(
        array $videosIds
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
