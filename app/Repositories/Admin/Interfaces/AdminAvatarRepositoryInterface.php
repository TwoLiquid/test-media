<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\MySql\AdminAvatar;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface AdminAvatarRepositoryInterface
 *
 * @package App\Repositories\Admin\Interfaces
 */
interface AdminAvatarRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return AdminAvatar|null
     */
    public function findById(
        int $id
    ) : ?AdminAvatar;

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
     * This method provides getting rows
     * with an eloquent model by certain query
     *
     * @param int $authId
     *
     * @return Collection
     */
    public function getByAuthId(
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
    public function getByAuthIds(
        array $authIds
    ) : Collection;

    /**
     * This method provides creating a new row
     * with an eloquent model
     *
     * @param int $authId
     * @param string $url
     * @param string $mime
     *
     * @return AdminAvatar|null
     */
    public function store(
        int $authId,
        string $url,
        string $mime
    ) : ?AdminAvatar;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param AdminAvatar $adminAvatar
     * @param int|null $authId
     * @param string|null $url
     * @param string|null $mime
     *
     * @return AdminAvatar
     */
    public function update(
        AdminAvatar $adminAvatar,
        ?int $authId,
        ?string $url,
        ?string $mime
    ) : AdminAvatar;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param AdminAvatar $adminAvatar
     *
     * @return bool|null
     */
    public function delete(
        AdminAvatar $adminAvatar
    ) : ?bool;

    /**
     * This method provides deleting existing rows
     * with an eloquent model
     *
     * @param array $ids
     *
     * @return bool|null
     */
    public function deleteByIds(
        array $ids
    ) : ?bool;
}
