<?php

namespace App\Repositories\Platform;

use App\Exceptions\DatabaseException;
use App\Models\MySql\PlatformIcon;
use App\Repositories\Platform\Interfaces\PlatformIconRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Exception;

/**
 * Class PlatformIconRepository
 *
 * @package App\Repositories\Platform
 */
class PlatformIconRepository implements PlatformIconRepositoryInterface
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
     * PlatformIconRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.platformIcon.perPage');
        $this->cacheTime = config('repositories.platformIcon.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return PlatformIcon|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?PlatformIcon
    {
        try {
            return PlatformIcon::find($id);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/platformIcon.' . __FUNCTION__),
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
            return PlatformIcon::all();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/platformIcon.' . __FUNCTION__),
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
            return PlatformIcon::query()
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/platformIcon.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $platformId
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getForPlatform(
        int $platformId
    ) : Collection
    {
        try {
            return PlatformIcon::query()
                ->where('platform_id', '=', $platformId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/platformIcon.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array $platformsIds
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getForPlatforms(
        array $platformsIds
    ) : Collection
    {
        try {
            return PlatformIcon::query()
                ->whereIn('platform_id', $platformsIds)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/platformIcon.' . __FUNCTION__),
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
            return PlatformIcon::query()
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/platformIcon.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $platformId
     * @param string $url
     * @param string $mime
     *
     * @return PlatformIcon|null
     *
     * @throws DatabaseException
     */
    public function store(
        int $platformId,
        string $url,
        string $mime
    ) : ?PlatformIcon
    {
        try {
            return PlatformIcon::create([
                'platform_id' => $platformId,
                'url'         => trim($url),
                'mime'        => trim($mime)
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/platformIcon.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param PlatformIcon $platformIcon
     * @param int|null $platformId
     * @param string|null $url
     * @param string|null $mime
     *
     * @return PlatformIcon
     *
     * @throws DatabaseException
     */
    public function update(
        PlatformIcon $platformIcon,
        ?int $platformId,
        ?string $url,
        ?string $mime
    ) : PlatformIcon
    {
        try {
            $platformIcon->update([
                'platform_id' => $platformId ?: $platformIcon->platform_id,
                'url'         => $url ? trim($url) : $platformIcon->url,
                'mime'        => $mime ? trim($mime) : $platformIcon->mime
            ]);

            return $platformIcon;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/platformIcon.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param PlatformIcon $platformIcon
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        PlatformIcon $platformIcon
    ) : bool
    {
        try {
            return PlatformIcon::query()
                ->where('id' , '=', $platformIcon->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/platformIcon.' . __FUNCTION__),
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
            return PlatformIcon::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/platformIcon.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
