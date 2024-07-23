<?php

namespace App\Repositories\Platform\Interfaces;

use App\Models\MySql\PlatformIcon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface PlatformIconRepositoryInterface
 *
 * @package App\Repositories\Platform\Interfaces
 */
interface PlatformIconRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return PlatformIcon|null
     */
    public function findById(
        int $id
    ) : ?PlatformIcon;

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
     * @param int $platformId
     *
     * @return Collection
     */
    public function getForPlatform(
        int $platformId
    ) : Collection;

    /**
     * This method provides getting rows
     * with an eloquent model by certain query
     *
     * @param array $platformsIds
     *
     * @return Collection
     */
    public function getForPlatforms(
        array $platformsIds
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
     * This method provides creating a new row
     * with an eloquent model
     *
     * @param int $platformId
     * @param string $url
     * @param string $mime
     *
     * @return PlatformIcon|null
     */
    public function store(
        int $platformId,
        string $url,
        string $mime
    ) : ?PlatformIcon;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param PlatformIcon $platformIcon
     * @param int|null $platformId
     * @param string|null $url
     * @param string|null $mime
     *
     * @return PlatformIcon
     */
    public function update(
        PlatformIcon $platformIcon,
        ?int $platformId,
        ?string $url,
        ?string $mime
    ) : PlatformIcon;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *

     * @param PlatformIcon $platformIcon
     *
     * @return bool
     */
    public function delete(
        PlatformIcon $platformIcon
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
