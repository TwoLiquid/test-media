<?php

namespace App\Repositories\Alert;

use App\Exceptions\DatabaseException;
use App\Models\MySql\Alert\AlertImage;
use App\Repositories\Alert\Interfaces\AlertImageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class AlertImageRepository
 *
 * @package App\Repositories\Alert
 */
class AlertImageRepository implements AlertImageRepositoryInterface
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
     * AlertImageRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.alertImage.perPage');
        $this->cacheTime = config('repositories.alertImage.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return AlertImage|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?AlertImage
    {
        try {
            return AlertImage::find($id);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/alert/alertImage.' . __FUNCTION__),
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
            return AlertImage::all();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/alert/alertImage.' . __FUNCTION__),
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
        ?int $page = null
    ) : LengthAwarePaginator
    {
        try {
            return AlertImage::query()
                ->orWhereNull('alert_id')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/alert/alertImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $alertId
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getForAlert(
        int $alertId
    ) : Collection
    {
        try {
            return AlertImage::query()
                ->where('alert_id', '=', $alertId)
                ->orWhereNull('alert_id')
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/alert/alertImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array $alertsIds
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getForAlerts(
        array $alertsIds
    ) : Collection
    {
        try {
            return AlertImage::query()
                ->whereIn('alert_id', $alertsIds)
                ->orWhereNull('alert_id')
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/alert/alertImage.' . __FUNCTION__),
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
            return AlertImage::query()
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/alert/alertImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int|null $alertId
     * @param string $url
     * @param string $mime
     *
     * @return AlertImage|null
     *
     * @throws DatabaseException
     */
    public function store(
        ?int $alertId,
        string $url,
        string $mime
    ) : ?AlertImage
    {
        try {
            return AlertImage::create([
                'alert_id' => $alertId,
                'url'      => trim($url),
                'mime'     => trim($mime)
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/alert/alertImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param AlertImage $alertImage
     * @param int|null $alertId
     * @param string|null $url
     * @param string|null $mime
     *
     * @return AlertImage
     *
     * @throws DatabaseException
     */
    public function update(
        AlertImage $alertImage,
        ?int $alertId,
        ?string $url,
        ?string $mime
    ) : AlertImage
    {
        try {
            $alertImage->update([
                'alert_id' => $alertId ?: $alertImage->alert_id,
                'url'      => $url ? trim($url) : $alertImage->url,
                'mime'     => $mime ? trim($mime) : $alertImage->mime
            ]);

            return $alertImage;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/alert/alertImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $alertId
     *
     * @throws DatabaseException
     */
    public function removeAllActive(
        int $alertId
    ) : void
    {
        try {
            AlertImage::query()
                ->where('alert_id', '=', $alertId)
                ->update([
                    'active' => false
                ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/alert/alertImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param AlertImage $alertImage
     * @param bool $active
     *
     * @return AlertImage
     *
     * @throws DatabaseException
     */
    public function updateActive(
        AlertImage $alertImage,
        bool $active
    ) : AlertImage
    {
        try {
            $alertImage->update([
                'alert_id' => $active
            ]);

            return $alertImage;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/alert/alertImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param AlertImage $alertImage
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        AlertImage $alertImage
    ) : bool
    {
        try {
            return AlertImage::query()
                ->where('id', '=', $alertImage->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/alert/alertImage.' . __FUNCTION__),
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
            return AlertImage::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/alert/alertImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
