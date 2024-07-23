<?php

namespace App\Repositories\Alert;

use App\Exceptions\DatabaseException;
use App\Models\MySql\Alert\AlertSound;
use App\Repositories\Alert\Interfaces\AlertSoundRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class AlertSoundRepository
 *
 * @package App\Repositories\Alert
 */
class AlertSoundRepository implements AlertSoundRepositoryInterface
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
     * AlertSoundRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.alertSound.perPage');
        $this->cacheTime = config('repositories.alertSound.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return AlertSound|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?AlertSound
    {
        try {
            return AlertSound::find($id);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/alert/alertSound.' . __FUNCTION__),
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
            return AlertSound::all();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/alert/alertSound.' . __FUNCTION__),
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
            return AlertSound::query()
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/alert/alertSound.' . __FUNCTION__),
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
            return AlertSound::query()
                ->where('alert_id', '=', $alertId)
                ->orWhereNull('alert_id')
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/alert/alertSound.' . __FUNCTION__),
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
            return AlertSound::query()
                ->whereIn('alert_id', $alertsIds)
                ->orWhereNull('alert_id')
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/alert/alertSound.' . __FUNCTION__),
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
            return AlertSound::query()
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/alert/alertSound.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $alertId
     * @param string $url
     * @param int $duration
     * @param string $mime
     *
     * @return AlertSound|null
     *
     * @throws DatabaseException
     */
    public function store(
        int $alertId,
        string $url,
        int $duration,
        string $mime
    ) : ?AlertSound
    {
        try {
            return AlertSound::create([
                'alert_id' => $alertId,
                'url'      => trim($url),
                'duration' => $duration,
                'mime'     => trim($mime)
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/alert/alertSound.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param AlertSound $alertSound
     * @param int|null $alertId
     * @param string|null $url
     * @param int|null $duration
     * @param string|null $mime
     *
     * @return AlertSound
     *
     * @throws DatabaseException
     */
    public function update(
        AlertSound $alertSound,
        ?int $alertId,
        ?string $url,
        ?int $duration,
        ?string $mime
    ) : AlertSound
    {
        try {
            $alertSound->update([
                'alert_id' => $alertId ?: $alertSound->alert_id,
                'url'      => $url ? trim($url) : $alertSound->url,
                'duration' => $duration ?: $alertSound->duration,
                'mime'     => $mime ? trim($mime) : $alertSound->mime
            ]);

            return $alertSound;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/alert/alertSound.' . __FUNCTION__),
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
            AlertSound::query()
                ->where('alert_id', '=', $alertId)
                ->update([
                    'active' => false
                ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/alert/alertSound.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param AlertSound $alertSound
     * @param bool $active
     *
     * @return AlertSound
     *
     * @throws DatabaseException
     */
    public function updateActive(
        AlertSound $alertSound,
        bool $active
    ) : AlertSound
    {
        try {
            $alertSound->update([
                'active' => $active
            ]);

            return $alertSound;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/alert/alertSound.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param AlertSound $alertSound
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        AlertSound $alertSound
    ) : bool
    {
        try {
            return AlertSound::query()
                ->where('id', '=', $alertSound->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/alert/alertSound.' . __FUNCTION__),
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
            return AlertSound::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/alert/alertSound.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
