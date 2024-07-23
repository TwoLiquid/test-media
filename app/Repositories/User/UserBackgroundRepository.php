<?php

namespace App\Repositories\User;

use App\Exceptions\DatabaseException;
use App\Models\MySql\User\UserBackground;
use App\Repositories\User\Interfaces\UserBackgroundRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class UserBackgroundRepository
 *
 * @package App\Repositories\User
 */
class UserBackgroundRepository implements UserBackgroundRepositoryInterface
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
     * UserBackgroundRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.userBackground.perPage');
        $this->cacheTime = config('repositories.userBackground.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return UserBackground|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?UserBackground
    {
        try {
            return UserBackground::find($id);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userBackground.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param string $requestId
     *
     * @return UserBackground|null
     *
     * @throws DatabaseException
     */
    public function findForRequest(
        string $requestId
    ) : ?UserBackground
    {
        try {
            return UserBackground::query()
                ->where('request_id', '=', $requestId)
                ->first();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userBackground.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $authId
     *
     * @return UserBackground|null
     *
     * @throws DatabaseException
     */
    public function findByUser(
        int $authId
    ) : ?UserBackground
    {
        try {
            return UserBackground::query()
                ->where('auth_id', '=', $authId)
                ->first();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userBackground.' . __FUNCTION__),
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
            return UserBackground::query()
                ->where('declined', '!=', true)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userBackground.' . __FUNCTION__),
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
            return UserBackground::query()
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userBackground.' . __FUNCTION__),
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
            return UserBackground::query()
                ->where('request_id', '=', $requestId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userBackground.' . __FUNCTION__),
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
            return UserBackground::query()
                ->where('auth_id', '=', $authId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userBackground.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array $authIds
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getForUsers(
        array $authIds
    ) : Collection
    {
        try {
            return UserBackground::query()
                ->whereIn('auth_id', $authIds)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userBackground.' . __FUNCTION__),
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
            return UserBackground::query()
                ->whereIn('id', $ids ?? [])
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userBackground.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $authId
     * @param string|null $requestId
     * @param string $url
     * @param string $mime
     * @param bool|null $declined
     *
     * @return UserBackground|null
     *
     * @throws DatabaseException
     */
    public function store(
        int $authId,
        ?string $requestId,
        string $url,
        string $mime,
        ?bool $declined = null
    ) : ?UserBackground
    {
        try {
            return UserBackground::create([
                'auth_id'    => $authId,
                'request_id' => $requestId,
                'url'        => trim($url),
                'mime'       => trim($mime),
                'declined'   => $declined
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userBackground.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param UserBackground $userBackground
     * @param int|null $authId
     * @param string|null $requestId
     * @param string|null $url
     * @param string|null $mime
     * @param bool|null $declined
     *
     * @return UserBackground
     *
     * @throws DatabaseException
     */
    public function update(
        UserBackground $userBackground,
        ?int $authId,
        ?string $requestId,
        ?string $url,
        ?string $mime,
        ?bool $declined
    ) : UserBackground
    {
        try {
            $userBackground->update([
                'auth_id'    => $authId ?: $userBackground->auth_id,
                'request_id' => $requestId ?: $userBackground->request_id,
                'url'        => $url ? trim($url) : $userBackground->url,
                'mime'       => $mime ? trim($mime) : $userBackground->mime,
                'declined'   => $declined ?: $userBackground->declined
            ]);

            return $userBackground;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userBackground.' . __FUNCTION__),
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
            UserBackground::query()
                ->where('request_id', '=', $requestId)
                ->update([
                    'declined' => false
                ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userBackground.' . __FUNCTION__),
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
            UserBackground::query()
                ->where('request_id', '=', $requestId)
                ->update([
                    'declined' => true
                ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userBackground.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param UserBackground $userBackground
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        UserBackground $userBackground
    ) : bool
    {
        try {
            return UserBackground::query()
                ->where('id', '=', $userBackground->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userBackground.' . __FUNCTION__),
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
            return UserBackground::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userBackground.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
