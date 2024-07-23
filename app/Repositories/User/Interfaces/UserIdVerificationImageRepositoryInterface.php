<?php

namespace App\Repositories\User\Interfaces;

use App\Models\MySql\User\UserIdVerificationImage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface UserIdVerificationImageRepositoryInterface
 *
 * @package App\Repositories\User\Interfaces
 */
interface UserIdVerificationImageRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return UserIdVerificationImage|null
     */
    public function findById(
        int $id
    ) : ?UserIdVerificationImage;

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
    public function getAllForRequest(
        string $requestId
    ) : Collection;

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
     * This method provides getting rows
     * with an eloquent model by certain query
     *
     * @param int $authId
     *
     * @return Collection
     */
    public function getDeclinedForUser(
        int $authId
    ) : Collection;

    /**
     * This method provides creating a new row
     * with an eloquent models
     *
     * @param int $authId
     * @param string $requestId
     * @param string $url
     * @param string $mime
     * @param bool|null $declined
     *
     * @return UserIdVerificationImage|null
     */
    public function store(
        int $authId,
        string $requestId,
        string $url,
        string $mime,
        ?bool $declined
    ) : ?UserIdVerificationImage;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param UserIdVerificationImage $userIdVerificationImage
     * @param int|null $authId
     * @param string|null $requestId
     * @param string|null $url
     * @param string|null $mime
     * @param bool|null $declined
     *
     * @return UserIdVerificationImage
     */
    public function update(
        UserIdVerificationImage $userIdVerificationImage,
        ?int $authId,
        ?string $requestId,
        ?string $url,
        ?string $mime,
        ?bool $declined
    ) : UserIdVerificationImage;

    /**
     * This method provides updating existing row
     * with an eloquent model
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
     * @param UserIdVerificationImage $userIdVerificationImage
     *
     * @return bool
     */
    public function delete(
        UserIdVerificationImage $userIdVerificationImage
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
