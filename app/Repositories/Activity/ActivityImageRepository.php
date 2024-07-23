<?php

namespace App\Repositories\Activity;

use App\Exceptions\DatabaseException;
use App\Models\MySql\ActivityImage;
use App\Repositories\Activity\Interfaces\ActivityImageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class ActivityImageRepositoryInterface
 *
 * @package App\Repositories
 */
class ActivityImageRepository implements ActivityImageRepositoryInterface
{
    /**
     * Cache time
     *
     * @var int
     */
    protected int $cacheTime;

    /**
     * Pagination step
     *
     * @var int
     */
    protected int $perPage;

    /**
     * ActivityImageRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.activityImage.perPage');
        $this->cacheTime = config('repositories.activityImage.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return ActivityImage|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?ActivityImage
    {
        try {
            return ActivityImage::find($id);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/activityImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getAll() : Collection
    {
        try {
            return ActivityImage::all();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/activityImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int|null $page
     *
     * @return LengthAwarePaginator
     *
     * @throws DatabaseException
     */
    public function getAllPaginated(
        ?int $page
    ) : LengthAwarePaginator
    {
        try {
            return ActivityImage::query()
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/activityImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array $ids
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getByIds(
        array $ids
    ) : Collection
    {
        try {
            return ActivityImage::query()
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/activityImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $activityId
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getForActivity(
        int $activityId
    ) : Collection
    {
        try {
            return ActivityImage::query()
                ->where('activity_id', '=', $activityId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/activityImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array|null $activitiesIds
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getForActivities(
        ?array $activitiesIds
    ) : Collection
    {
        try {
            return ActivityImage::query()
                ->whereIn('activity_id', $activitiesIds ?? [])
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/activityImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $activityId
     * @param array $types
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getForActivityByTypes(
        int $activityId,
        array $types
    ) : Collection
    {
        try {
            return ActivityImage::query()
                ->where('activity_id', '=', $activityId)
                ->whereIn('type', $types)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/activityImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array|null $activitiesIds
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getPostersForActivities(
        ?array $activitiesIds
    ) : Collection
    {
        try {
            return ActivityImage::query()
                ->whereIn('activity_id', $activitiesIds)
                ->where('type', '=', 'poster')
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/activityImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $activityId
     * @param string $type
     * @param string $url
     * @param string $mime
     *
     * @return ActivityImage|null
     *
     * @throws DatabaseException
     */
    public function store(
        int $activityId,
        string $type,
        string $url,
        string $mime
    ) : ?ActivityImage
    {
        try {
            return ActivityImage::create([
                'activity_id' => $activityId,
                'type'        => $type,
                'url'         => trim($url),
                'mime'        => trim($mime)
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/activityImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param ActivityImage $activityImage
     * @param int|null $activityId
     * @param string|null $type
     * @param string|null $url
     * @param string|null $mime
     *
     * @return ActivityImage
     *
     * @throws DatabaseException
     */
    public function update(
        ActivityImage $activityImage,
        ?int $activityId,
        ?string $type,
        ?string $url,
        ?string $mime
    ) : ActivityImage
    {
        try {
            $activityImage->update([
                'activity_id' => $activityId ?: $activityImage->activity_id,
                'type'        => $type ?: $activityImage->type,
                'url'         => $url ? trim($url) : $activityImage->url,
                'mime'        => $mime ? trim($mime) : $activityImage->mime
            ]);

            return $activityImage;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/activityImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param ActivityImage $activityImage
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        ActivityImage $activityImage
    ) : bool
    {
        try {
            return ActivityImage::query()
                ->where('id', '=', $activityImage->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/activityImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array $ids
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function deleteByIds(
        array $ids
    ) : bool
    {
        try {
            return ActivityImage::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/activityImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
