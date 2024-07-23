<?php

namespace App\Repositories\Alert\Interfaces;

use App\Models\MySql\Alert\AlertSound;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface AlertSoundRepositoryInterface
 *
 * @package App\Repositories\Alert\Interfaces
 */
interface AlertSoundRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return AlertSound|null
     */
    public function findById(
        int $id
    ) : ?AlertSound;

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
     * @param int $alertId
     *
     * @return Collection
     */
    public function getForAlert(
        int $alertId
    ) : Collection;

    /**
     * This method provides getting rows
     * with an eloquent model by certain query
     *
     * @param array $alertsIds
     *
     * @return Collection
     */
    public function getForAlerts(
        array $alertsIds
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
     * with an eloquent models
     *
     * @param int $alertId
     * @param string $url
     * @param int $duration
     * @param string $mime
     *
     * @return AlertSound|null
     */
    public function store(
        int $alertId,
        string $url,
        int $duration,
        string $mime
    ) : ?AlertSound;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param AlertSound $alertSound
     * @param int|null $alertId
     * @param string|null $url
     * @param int|null $duration
     * @param string|null $mime
     *
     * @return AlertSound
     */
    public function update(
        AlertSound $alertSound,
        ?int $alertId,
        ?string $url,
        ?int $duration,
        ?string $mime
    ) : AlertSound;

    /**
     * This method provides updating existing rows
     * with an eloquent model
     *
     * @param int $alertId
     */
    public function removeAllActive(
        int $alertId
    ) : void;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param AlertSound $alertSound
     * @param bool $active
     *
     * @return AlertSound
     */
    public function updateActive(
        AlertSound $alertSound,
        bool $active
    ) : AlertSound;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param AlertSound $alertSound
     *
     * @return bool
     */
    public function delete(
        AlertSound $alertSound
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
