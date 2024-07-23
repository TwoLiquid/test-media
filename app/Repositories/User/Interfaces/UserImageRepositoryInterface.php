<?php

namespace App\Repositories\User\Interfaces;

use App\Models\MySql\User\UserImage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface UserImageRepositoryInterface
 *
 * @package App\Repositories\User\Interfaces
 */
interface UserImageRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return UserImage|null
     */
    public function findById(
        int $id
    ) : ?UserImage;

    /**
     * This method provides finding a single row
     * with an eloquent model by certain query
     *
     * @param int $authId
     * @param int $id
     *
     * @return UserImage|null
     */
    public function findForUser(
        int $authId,
        int $id
    ) : ?UserImage;

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
     * This method provides getting all rows
     * with an eloquent model by certain query
     *
     * @param string $requestId
     *
     * @return Collection
     */
    public function getForRequest(
        string $requestId
    ) : Collection;

    /**
     * This method provides getting rows
     * with an eloquent model by certain query
     *
     * @param array|null $ids
     *
     * @return Collection
     */
    public function getByIds(
        ?array $ids
    ) : Collection;

    /**
     * This method provides getting rows
     * with an eloquent model by certain query
     *
     * @param int $authId
     *
     * @return Collection
     */
    public function getForUser(
        int $authId
    ) : Collection;

    /**
     * This method provides getting rows
     * with an eloquent model by certain query
     *
     * @param array $authIds
     *
     * @return Collection
     */
    public function getForUsers(
        array $authIds
    ) : Collection;

    /**
     * This method provides creating a new row
     * with an eloquent model
     *
     * @param int $authId
     * @param string|null $requestId
     * @param string $url
     * @param string $mime
     * @param bool|null $declined
     *
     * @return UserImage|null
     */
    public function store(
        int $authId,
        ?string $requestId,
        string $url,
        string $mime,
        ?bool $declined
    ) : ?UserImage;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param UserImage $userImage
     * @param int|null $authId
     * @param string|null $requestId
     * @param string|null $url
     * @param string|null $mime
     * @param bool|null $declined
     *
     * @return UserImage
     */
    public function update(
        UserImage $userImage,
        ?int $authId,
        ?string $requestId,
        ?string $url,
        ?string $mime,
        ?bool $declined
    ) : UserImage;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param UserImage $userImage
     * @param int $likes
     *
     * @return UserImage
     */
    public function updateLikes(
        UserImage $userImage,
        int $likes
    ) : UserImage;

    /**
     * This method provides updating existing rows
     * by related entity repository
     *
     * @param string $requestId
     */
    public function acceptForRequest(
        string $requestId
    ) : void;

    /**
     * This method provides updating existing rows
     * by related entity repository
     *
     * @param string $requestId
     */
    public function declineForRequest(
        string $requestId
    ) : void;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param UserImage $userImage
     *
     * @return bool
     */
    public function delete(
        UserImage $userImage
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
