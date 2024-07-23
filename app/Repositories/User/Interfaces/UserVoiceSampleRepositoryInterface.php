<?php

namespace App\Repositories\User\Interfaces;

use App\Models\MySql\User\UserVoiceSample;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface UserVoiceSampleRepositoryInterface
 *
 * @package App\Repositories\User\Interfaces
 */
interface UserVoiceSampleRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int|null $id
     *
     * @return UserVoiceSample|null
     */
    public function findById(
        ?int $id
    ) : ?UserVoiceSample;

    /**
     * This method provides finding a single row
     * with an eloquent model by certain query
     *
     * @param string $requestId
     *
     * @return UserVoiceSample|null
     */
    public function findForRequest(
        string $requestId
    ) : ?UserVoiceSample;

    /**
     * This method provides getting a single row
     * with an eloquent model by certain query
     *
     * @param int $authId
     *
     * @return UserVoiceSample|null
     */
    public function findForUser(
        int $authId
    ) : ?UserVoiceSample;

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
     * @param array|null $authIds
     *
     * @return Collection
     */
    public function getForUsers(
        ?array $authIds
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
     * @return UserVoiceSample|null
     */
    public function store(
        int $authId,
        ?string $requestId,
        string $url,
        int $duration,
        string $mime,
        ?bool $declined
    ) : ?UserVoiceSample;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param UserVoiceSample $userVoiceSample
     * @param int|null $authId
     * @param string|null $requestId
     * @param string|null $url
     * @param int|null $duration
     * @param string|null $mime
     * @param bool|null $declined
     *
     * @return UserVoiceSample
     */
    public function update(
        UserVoiceSample $userVoiceSample,
        ?int $authId,
        ?string $requestId,
        ?string $url,
        ?int $duration,
        ?string $mime,
        ?bool $declined
    ) : UserVoiceSample;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param string $requestId
     */
    public function acceptForRequest(
        string $requestId
    ) : void;

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
     * @param UserVoiceSample $userVoiceSample
     *
     * @return bool
     */
    public function delete(
        UserVoiceSample $userVoiceSample
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
