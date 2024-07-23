<?php

namespace App\Repositories\User\Interfaces;

use App\Models\MySql\User\UserVideo;
use App\Models\MySql\User\UserVideoThumbnail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface UserVideoThumbnailRepositoryInterface
 *
 * @package App\Repositories\User\Interfaces
 */
interface UserVideoThumbnailRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $authId
     * @param int $id
     *
     * @return UserVideoThumbnail|null
     */
    public function findById(
        int $authId,
        int $id
    ) : ?UserVideoThumbnail;

    /**
     * This method provides getting all rows
     * with an eloquent model
     *
     * @param int $authId
     *
     * @return Collection
     */
    public function getAll(
        int $authId
    ) : Collection;

    /**
     * This method provides getting all rows
     * with an eloquent model with pagination
     *
     * @param int $authId
     * @param int|null $page
     *
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(
        int $authId,
        ?int $page
    ) : LengthAwarePaginator;

    /**
     * This method provides getting rows
     * with an eloquent model by certain query
     *
     * @param int $authId
     * @param array $userVideoThumbnailsIds
     *
     * @return Collection
     */
    public function getByIds(
        int $authId,
        array $userVideoThumbnailsIds
    ) : Collection;

    /**
     * This method provides creating a new row
     * with an eloquent model
     *
     * @param UserVideo $userVideo
     * @param string $url
     * @param string $mime
     *
     * @return UserVideoThumbnail|null
     */
    public function store(
        UserVideo $userVideo,
        string $url,
        string $mime
    ) : ?UserVideoThumbnail;

    /**
     * This method provides creating a new row
     * with an eloquent model
     *
     * @param UserVideoThumbnail $userVideoThumbnail
     * @param UserVideo|null $userVideo
     * @param string|null $url
     * @param string|null $mime
     *
     * @return UserVideoThumbnail
     */
    public function update(
        UserVideoThumbnail $userVideoThumbnail,
        ?UserVideo $userVideo,
        ?string $url,
        ?string $mime
    ) : UserVideoThumbnail;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param int $authId
     * @param UserVideoThumbnail $userVideoThumbnail
     *
     * @return bool|null
     */
    public function delete(
        int $authId,
        UserVideoThumbnail $userVideoThumbnail
    ) : ?bool;

    /**
     * This method provides deleting existing rows
     * with an eloquent model
     *
     * @param array $userVideosIds
     *
     * @return bool
     */
    public function deleteByVideosIds(
        array $userVideosIds
    ) : bool;

    /**
     * This method provides deleting existing rows
     * with an eloquent model
     *
     * @param int $authId
     * @param array $userVideoThumbnailsIds
     *
     * @return bool|null
     */
    public function deleteByIds(
        int $authId,
        array $userVideoThumbnailsIds
    ) : ?bool;
}
