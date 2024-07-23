<?php

namespace App\Repositories\Device\Interfaces;

use App\Models\MySql\DeviceIcon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface DeviceIconRepositoryInterface
 *
 * @package App\Repositories\Device\Interfaces
 */
interface DeviceIconRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return DeviceIcon|null
     */
    public function findById(
        int $id
    ) : ?DeviceIcon;

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
     * @param int $deviceId
     *
     * @return Collection
     */
    public function getForDevice(
        int $deviceId
    ) : Collection;

    /**
     * This method provides getting rows
     * with an eloquent model by certain query
     *
     * @param array $devicesIds
     *
     * @return Collection
     */
    public function getForDevices(
        array $devicesIds
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
     * @param int $deviceId
     * @param string $url
     * @param string $mime
     *
     * @return DeviceIcon|null
     */
    public function store(
        int $deviceId,
        string $url,
        string $mime
    ) : ?DeviceIcon;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param DeviceIcon $deviceIcon
     * @param int|null $deviceId
     * @param string|null $url
     * @param string|null $mime
     *
     * @return DeviceIcon
     */
    public function update(
        DeviceIcon $deviceIcon,
        ?int $deviceId,
        ?string $url,
        ?string $mime
    ) : DeviceIcon;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param DeviceIcon $deviceIcon
     *
     * @return bool
     */
    public function delete(
        DeviceIcon $deviceIcon
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
