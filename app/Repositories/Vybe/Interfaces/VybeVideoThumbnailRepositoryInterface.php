<?php

namespace App\Repositories\Vybe\Interfaces;

use App\Models\MySql\Vybe\VybeVideo;
use App\Models\MySql\Vybe\VybeVideoThumbnail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface VybeVideoThumbnailRepositoryInterface
 *
 * @package App\Repositories\Vybe\Interfaces
 */
interface VybeVideoThumbnailRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return VybeVideoThumbnail|null
     */
    public function findById(
        int $id
    ) : ?VybeVideoThumbnail;

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
     * @param array $vybeVideoThumbnailsIds
     *
     * @return Collection
     */
    public function getByIds(
        array $vybeVideoThumbnailsIds
    ) : Collection;

    /**
     * This method provides creating a new row
     * with an eloquent models
     *
     * @param VybeVideo $vybeVideo
     * @param string $url
     * @param string $mime
     *
     * @return VybeVideoThumbnail|null
     */
    public function store(
        VybeVideo $vybeVideo,
        string $url,
        string $mime
    ) : ?VybeVideoThumbnail;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param VybeVideoThumbnail $vybeVideoThumbnail
     * @param VybeVideo|null $vybeVideo
     * @param string|null $url
     * @param string|null $mime
     *
     * @return VybeVideoThumbnail
     */
    public function update(
        VybeVideoThumbnail $vybeVideoThumbnail,
        ?VybeVideo $vybeVideo,
        ?string $url,
        ?string $mime
    ) : VybeVideoThumbnail;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param VybeVideoThumbnail $vybeVideoThumbnail
     *
     * @return bool
     */
    public function delete(
        VybeVideoThumbnail $vybeVideoThumbnail
    ) : bool;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param array $vybeVideosIds
     *
     * @return bool
     */
    public function deleteByVideosIds(
        array $vybeVideosIds
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
