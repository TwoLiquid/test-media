<?php

namespace App\Repositories\Device;

use App\Exceptions\DatabaseException;
use App\Models\MySql\DeviceIcon;
use App\Repositories\Device\Interfaces\DeviceIconRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Exception;

/**
 * Class DeviceIconRepository
 *
 * @package App\Repositories\Device
 */
class DeviceIconRepository implements DeviceIconRepositoryInterface
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
     * Cache usage
     */
    protected bool $caching;

    /**
     * DeviceIconRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.deviceIcon.perPage');
        $this->cacheTime = config('repositories.deviceIcon.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return DeviceIcon|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?DeviceIcon
    {
        try {
            return DeviceIcon::find($id);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/deviceIcon.' . __FUNCTION__),
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
            return DeviceIcon::all();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/deviceIcon.' . __FUNCTION__),
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
            return DeviceIcon::query()
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/deviceIcon.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $deviceId
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getForDevice(
        int $deviceId
    ) : Collection
    {
        try {
            return DeviceIcon::query()
                ->where('device_id', '=', $deviceId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/deviceIcon.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array $devicesIds
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getForDevices(
        array $devicesIds
    ) : Collection
    {
        try {
            return DeviceIcon::query()
                ->whereIn('device_id', $devicesIds)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/deviceIcon.' . __FUNCTION__),
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
            return DeviceIcon::query()
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/deviceIcon.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $deviceId
     * @param string $url
     * @param string $mime
     *
     * @return DeviceIcon|null
     *
     * @throws DatabaseException
     */
    public function store(
        int $deviceId,
        string $url,
        string $mime
    ) : ?DeviceIcon
    {
        try {
            return DeviceIcon::create([
                'device_id' => $deviceId,
                'url'       => trim($url),
                'mime'      => trim($mime)
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/deviceIcon.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param DeviceIcon $deviceIcon
     * @param int|null $deviceId
     * @param string|null $url
     * @param string|null $mime
     *
     * @return DeviceIcon
     *
     * @throws DatabaseException
     */
    public function update(
        DeviceIcon $deviceIcon,
        ?int $deviceId,
        ?string $url,
        ?string $mime
    ) : DeviceIcon
    {
        try {
            $deviceIcon->update([
                'device_id' => $deviceId ?: $deviceIcon->device_id,
                'url'       => $url ? trim($url) : $deviceIcon->url,
                'mime'      => $mime ? trim($mime) : $deviceIcon->mime
            ]);

            return $deviceIcon;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/deviceIcon.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param DeviceIcon $deviceIcon
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        DeviceIcon $deviceIcon
    ) : bool
    {
        try {
            return DeviceIcon::query()
                ->where('id' , '=', $deviceIcon->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/deviceIcon.' . __FUNCTION__),
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
            return DeviceIcon::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/deviceIcon.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
