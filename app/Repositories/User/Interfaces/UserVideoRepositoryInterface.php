<?php

namespace App\Repositories\User\Interfaces;

use App\Models\MySql\User\UserVideo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface UserVideoRepositoryInterface
 *
 * @package App\Repositories\User\Interfaces
 */
interface UserVideoRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return UserVideo|null
     */
    public function findById(
        int $id
    ) : ?UserVideo;

    /**
     * This method provides finding a single row
     * with an eloquent model by certain query
     *
     * @param int $authId
     * @param int $id
     *
     * @return UserVideo|null
     */
    public function findForUser(
        int $authId,
        int $id
    ) : ?UserVideo;

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
     * with an eloquent model with pagination
     *
     * @param string $requestId
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
     * @param int $duration
     * @param string $mime
     * @param bool|null $declined
     *
     * @return UserVideo|null
     */
    public function store(
        int $authId,
        ?string $requestId,
        string $url,
        int $duration,
        string $mime,
        ?bool $declined
    ) : ?UserVideo;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param UserVideo $userVideo
     * @param int|null $authId
     * @param string|null $requestId
     * @param string|null $url
     * @param int|null $duration
     * @param string|null $mime
     * @param bool|null $declined
     *
     * @return UserVideo
     */
    public function update(
        UserVideo $userVideo,
        ?int $authId,
        ?string $requestId,
        ?string $url,
        ?int $duration,
        ?string $mime,
        ?bool $declined
    ) : UserVideo;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param UserVideo $userVideo
     * @param int $likes
     *
     * @return UserVideo
     */
    public function updateLikes(
        UserVideo $userVideo,
        int $likes
    ) : UserVideo;

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
     * @param UserVideo $userVideo
     *
     * @return bool
     */
    public function delete(
        UserVideo $userVideo
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
