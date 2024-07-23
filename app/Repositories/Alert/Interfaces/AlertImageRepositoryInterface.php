<?php

namespace App\Repositories\Alert\Interfaces;

use App\Models\MySql\Alert\AlertImage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface AlertImageRepositoryInterface
 *
 * @package App\Repositories\Alert\Interfaces
 */
interface AlertImageRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return AlertImage|null
     */
    public function findById(
        int $id
    ) : ?AlertImage;

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
     * @param int $alertId
     *
     * @return Collection
     */
    public function getForAlert(
        int $alertId
    ) : Collection;

    /**
     * This method provides getting all rows
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
     * @param int|null $alertId
     * @param string $url
     * @param string $mime
     *
     * @return AlertImage|null
     */
    public function store(
        ?int $alertId,
        string $url,
        string $mime
    ) : ?AlertImage;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param AlertImage $alertImage
     * @param int|null $alertId
     * @param string|null $url
     * @param string|null $mime
     *
     * @return AlertImage
     */
    public function update(
        AlertImage $alertImage,
        ?int $alertId,
        ?string $url,
        ?string $mime
    ) : AlertImage;

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
     * @param AlertImage $alertImage
     * @param bool $active
     *
     * @return AlertImage
     */
    public function updateActive(
        AlertImage $alertImage,
        bool $active
    ) : AlertImage;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param AlertImage $alertImage
     *
     * @return bool
     */
    public function delete(
        AlertImage $alertImage
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
