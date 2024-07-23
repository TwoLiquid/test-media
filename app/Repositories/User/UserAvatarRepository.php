<?php

namespace App\Repositories\User;

use App\Exceptions\DatabaseException;
use App\Models\MySql\User\UserAvatar;
use App\Repositories\User\Interfaces\UserAvatarRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class UserAvatarRepository
 *
 * @package App\Repositories\User
 */
class UserAvatarRepository implements UserAvatarRepositoryInterface
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
     * UserAvatarRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.userAvatar.perPage');
        $this->cacheTime = config('repositories.userAvatar.cacheTime');
    }

    /**
     * @param int|null $id
     *
     * @return UserAvatar|null
     *
     * @throws DatabaseException
     */
    public function findById(
        ?int $id
    ) : ?UserAvatar
    {
        try {
            return UserAvatar::find($id);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userAvatar.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param string $requestId
     *
     * @return UserAvatar|null
     *
     * @throws DatabaseException
     */
    public function findForRequest(
        string $requestId
    ) : ?UserAvatar
    {
        try {
            return UserAvatar::query()
                ->where('request_id', '=', $requestId)
                ->first();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userAvatar.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $authId
     *
     * @return UserAvatar|null
     *
     * @throws DatabaseException
     */
    public function findForUser(
        int $authId
    ) : ?UserAvatar
    {
        try {
            return UserAvatar::query()
                ->where('auth_id', '=', $authId)
                ->first();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userAvatar.' . __FUNCTION__),
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
            return UserAvatar::query()
                ->where('declined', '!=', true)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userAvatar.' . __FUNCTION__),
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
            return UserAvatar::query()
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userAvatar.' . __FUNCTION__),
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
            return UserAvatar::query()
                ->where('request_id', '=', $requestId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userAvatar.' . __FUNCTION__),
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
            return UserAvatar::query()
                ->whereIn('id', $ids ?? [])
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userAvatar.' . __FUNCTION__),
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
            return UserAvatar::query()
                ->where('auth_id', '=', $authId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userAvatar.' . __FUNCTION__),
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
            return UserAvatar::query()
                ->whereIn('auth_id', $authIds)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userAvatar.' . __FUNCTION__),
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
     * @return UserAvatar|null
     *
     * @throws DatabaseException
     */
    public function store(
        int $authId,
        ?string $requestId,
        string $url,
        string $mime,
        ?bool $declined = null
    ) : ?UserAvatar
    {
        try {
            return UserAvatar::create([
                'auth_id'    => $authId,
                'request_id' => $requestId,
                'url'        => trim($url),
                'mime'       => trim($mime),
                'declined'   => $declined
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userAvatar.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param UserAvatar $userAvatar
     * @param int|null $authId
     * @param string|null $requestId
     * @param string|null $url
     * @param string|null $mime
     * @param bool|null $declined
     *
     * @return UserAvatar
     *
     * @throws DatabaseException
     */
    public function update(
        UserAvatar $userAvatar,
        ?int $authId,
        ?string $requestId,
        ?string $url,
        ?string $mime,
        ?bool $declined
    ) : UserAvatar
    {
        try {
            $userAvatar->update([
                'auth_id'    => $authId ?: $userAvatar->auth_id,
                'request_id' => $requestId ?: $userAvatar->request_id,
                'url'        => $url ? trim($url) : $userAvatar->url,
                'mime'       => $mime ? trim($mime) : $userAvatar->mime,
                'declined'   => $declined ?: $userAvatar->declined
            ]);

            return $userAvatar;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userAvatar.' . __FUNCTION__),
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
            UserAvatar::query()
                ->where('request_id', '=', $requestId)
                ->update([
                    'declined' => false
                ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userAvatar.' . __FUNCTION__),
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
            UserAvatar::query()
                ->where('request_id', '=', $requestId)
                ->update([
                    'declined' => true
                ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userAvatar.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param UserAvatar $userAvatar
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        UserAvatar $userAvatar
    ) : bool
    {
        try {
            return UserAvatar::query()
                ->where('id', '=', $userAvatar->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userAvatar.' . __FUNCTION__),
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
            return UserAvatar::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userAvatar.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
