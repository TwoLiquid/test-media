<?php

namespace App\Repositories\User;

use App\Exceptions\DatabaseException;
use App\Models\MySql\User\UserVoiceSample;
use App\Repositories\User\Interfaces\UserVoiceSampleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class UserVoiceSampleRepository
 *
 * @package App\Repositories\User
 */
class UserVoiceSampleRepository implements UserVoiceSampleRepositoryInterface
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
     * UserVoiceSampleRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.userVoiceSample.perPage');
        $this->cacheTime = config('repositories.userVoiceSample.cacheTime');
    }

    /**
     * @param int|null $id
     *
     * @return UserVoiceSample|null
     *
     * @throws DatabaseException
     */
    public function findById(
        ?int $id
    ) : ?UserVoiceSample
    {
        try {
            return UserVoiceSample::find($id);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVoiceSample.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param string $requestId
     *
     * @return UserVoiceSample|null
     *
     * @throws DatabaseException
     */
    public function findForRequest(
        string $requestId
    ) : ?UserVoiceSample
    {
        try {
            return UserVoiceSample::query()
                ->where('request_id', '=', $requestId)
                ->first();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVoiceSample.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $authId
     *
     * @return UserVoiceSample|null
     *
     * @throws DatabaseException
     */
    public function findForUser(
        int $authId
    ) : ?UserVoiceSample
    {
        try {
            return UserVoiceSample::query()
                ->where('auth_id', '=', $authId)
                ->where('declined', '!=', true)
                ->first();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVoiceSample.' . __FUNCTION__),
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
            return UserVoiceSample::all();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVoiceSample.' . __FUNCTION__),
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
            return UserVoiceSample::query()
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVoiceSample.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param string $requestId
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getForRequest(
        string $requestId
    ) : Collection
    {
        try {
            return UserVoiceSample::query()
                ->where('request_id', '=', $requestId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVoiceSample.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array|null $ids
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getByIds(
        ?array $ids
    ) : Collection
    {
        try {
            return UserVoiceSample::query()
                ->whereIn('id', $ids ?? [])
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVoiceSample.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $authId
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getForUser(
        int $authId
    ) : Collection
    {
        try {
            return UserVoiceSample::query()
                ->where('auth_id', '=', $authId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVoiceSample.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array|null $authIds
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getForUsers(
        ?array $authIds
    ) : Collection
    {
        try {
            return UserVoiceSample::query()
                ->whereIn('auth_id', $authIds)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVoiceSample.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $authId
     * @param string|null $requestId
     * @param string $url
     * @param int $duration
     * @param string $mime
     * @param bool|null $declined
     *
     * @return UserVoiceSample|null
     *
     * @throws DatabaseException
     */
    public function store(
        int $authId,
        ?string $requestId,
        string $url,
        int $duration,
        string $mime,
        ?bool $declined = null
    ) : ?UserVoiceSample
    {
        try {
            return UserVoiceSample::create([
                'auth_id'    => $authId,
                'request_id' => $requestId,
                'url'        => trim($url),
                'duration'   => $duration,
                'mime'       => trim($mime),
                'declined'   => $declined
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVoiceSample.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param UserVoiceSample $userVoiceSample
     * @param int|null $authId
     * @param string|null $requestId
     * @param string|null $url
     * @param int|null $duration
     * @param string|null $mime
     * @param bool|null $declined
     *
     * @return UserVoiceSample
     *
     * @throws DatabaseException
     */
    public function update(
        UserVoiceSample $userVoiceSample,
        ?int $authId,
        ?string $requestId,
        ?string $url,
        ?int $duration,
        ?string $mime,
        ?bool $declined
    ) : UserVoiceSample
    {
        try {
            $userVoiceSample->update([
                'auth_id'    => $authId ?: $userVoiceSample->auth_id,
                'request_id' => $requestId ?: $userVoiceSample ->request_id,
                'url'        => $url ? trim($url) : $userVoiceSample->url,
                'duration'   => $duration ?: $userVoiceSample->duration,
                'mime'       => $mime ? trim($mime) : $userVoiceSample->mime,
                'declined'   => $declined ?: $userVoiceSample->declined
            ]);

            return $userVoiceSample;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVoiceSample.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param string $requestId
     *
     * @throws DatabaseException
     */
    public function acceptForRequest(
        string $requestId
    ) : void
    {
        try {
            UserVoiceSample::query()
                ->where('request_id', '=', $requestId)
                ->update([
                    'declined' => false
                ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVoiceSample.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param string $requestId
     *
     * @throws DatabaseException
     */
    public function declineForRequest(
        string $requestId
    ) : void
    {
        try {
            UserVoiceSample::query()
                ->where('request_id', '=', $requestId)
                ->update([
                    'declined' => true
                ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVoiceSample.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param UserVoiceSample $userVoiceSample
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        UserVoiceSample $userVoiceSample
    ) : bool
    {
        try {
            return UserVoiceSample::query()
                ->where('id', '=', $userVoiceSample->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVoiceSample.' . __FUNCTION__),
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
            return UserVoiceSample::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVoiceSample.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
