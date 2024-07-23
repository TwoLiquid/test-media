<?php

namespace App\Repositories\Activity\Interfaces;

use App\Models\MySql\ActivityImage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface ActivityImageRepositoryInterface
 *
 * @package App\Repositories\Activity\Interfaces
 */
interface ActivityImageRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return ActivityImage|null
     */
    public function findById(
        int $id
    ) : ?ActivityImage;

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
     * @param int $activityId
     *
     * @return Collection
     */
    public function getForActivity(
        int $activityId
    ) : Collection;

    /**
     * This method provides getting rows
     * with an eloquent model by certain query
     *
     * @param array|null $activitiesIds
     *
     * @return Collection
     */
    public function getForActivities(
        ?array $activitiesIds
    ) : Collection;

    /**
     * This method provides getting rows
     * with an eloquent model by certain query
     *
     * @param int $activityId
     * @param array $types
     *
     * @return Collection
     */
    public function getForActivityByTypes(
        int $activityId,
        array $types
    ) : Collection;

    /**
     * This method provides getting rows
     * with an eloquent model by certain query
     *
     * @param array|null $activitiesIds
     *
     * @return Collection
     */
    public function getPostersForActivities(
        ?array $activitiesIds
    ) : Collection;

    /**
     * This method provides creating a new row
     * with an eloquent model
     *
     * @param int $activityId
     * @param string $type
     * @param string $url
     * @param string $mime
     *
     * @return ActivityImage|null
     */
    public function store(
        int $activityId,
        string $type,
        string $url,
        string $mime
    ) : ?ActivityImage;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param ActivityImage $activityImage
     * @param int|null $activityId
     * @param string|null $type
     * @param string|null $url
     * @param string|null $mime
     *
     * @return ActivityImage
     */
    public function update(
        ActivityImage $activityImage,
        ?int $activityId,
        ?string $type,
        ?string $url,
        ?string $mime
    ) : ActivityImage;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param ActivityImage $activityImage
     *
     * @return bool
     */
    public function delete(
        ActivityImage $activityImage
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
