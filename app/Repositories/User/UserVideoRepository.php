<?php

namespace App\Repositories\User;

use App\Exceptions\DatabaseException;
use App\Models\MySql\User\UserVideo;
use App\Repositories\User\Interfaces\UserVideoRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class UserVideoRepository
 *
 * @package App\Repositories\User
 */
class UserVideoRepository implements UserVideoRepositoryInterface
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
     * UserVideoRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.userVideo.perPage');
        $this->cacheTime = config('repositories.userVideo.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return UserVideo|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?UserVideo
    {
        try {
            return UserVideo::query()
                ->with([
                    'thumbnail'
                ])
                ->find($id);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $authId
     * @param int $id
     *
     * @return UserVideo|null
     *
     * @throws DatabaseException
     */
    public function findForUser(
        int $authId,
        int $id
    ) : ?UserVideo
    {
        try {
            return UserVideo::query()
                ->with([
                    'thumbnail'
                ])
                ->where('auth_id', '=', $authId)
                ->where('id', '=', $id)
                ->first();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVideo.' . __FUNCTION__),
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
            return UserVideo::query()
                ->with([
                    'thumbnail'
                ])
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVideo.' . __FUNCTION__),
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
            return UserVideo::query()
                ->with([
                    'thumbnail'
                ])
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVideo.' . __FUNCTION__),
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
            return UserVideo::query()
                ->with([
                    'thumbnail'
                ])
                ->where('request_id', '=', $requestId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVideo.' . __FUNCTION__),
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
            return UserVideo::query()
                ->with([
                    'thumbnail'
                ])
                ->whereIn('id', $ids ?? [])
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVideo.' . __FUNCTION__),
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
            return UserVideo::query()
                ->with([
                    'thumbnail'
                ])
                ->where('auth_id', '=', $authId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVideo.' . __FUNCTION__),
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
            return UserVideo::query()
                ->with([
                    'thumbnail'
                ])
                ->whereIn('auth_id', $authIds)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVideo.' . __FUNCTION__),
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
     * @return UserVideo|null
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
    ) : ?UserVideo
    {
        try {
            return UserVideo::create([
                'auth_id'    => $authId,
                'request_id' => $requestId,
                'url'        => trim($url),
                'duration'   => $duration,
                'mime'       => trim($mime),
                'declined'   => $declined,
                'likes'      => 0
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param UserVideo $userVideo
     * @param int|null $authId
     * @param string|null $requestId
     * @param string|null $url
     * @param int|null $duration
     * @param string|null $mime
     * @param bool|null $declined
     *
     * @return UserVideo
     *
     * @throws DatabaseException
     */
    public function update(
        UserVideo $userVideo,
        ?int $authId,
        ?string $requestId,
        ?string $url,
        ?int $duration,
        ?string $mime,
        ?bool $declined
    ) : UserVideo
    {
        try {
            $userVideo->update([
                'auth_id'    => $authId ?: $userVideo->auth_id,
                'request_id' => $requestId ?: $userVideo ->request_id,
                'url'        => $url ? trim($url) : $userVideo->url,
                'duration'   => $duration ?: $userVideo->duration,
                'mime'       => $mime ? trim($mime) : $userVideo->mime,
                'declined'   => $declined ?: $userVideo->declined
            ]);

            return $userVideo;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param UserVideo $userVideo
     * @param int $likes
     *
     * @return UserVideo
     *
     * @throws DatabaseException
     */
    public function updateLikes(
        UserVideo $userVideo,
        int $likes
    ) : UserVideo
    {
        try {
            $userVideo->update([
                'likes' => $likes
            ]);

            return $userVideo;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVideo.' . __FUNCTION__),
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
            UserVideo::query()
                ->where('request_id' , '=', $requestId)
                ->update([
                    'declined' => false
                ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVideo.' . __FUNCTION__),
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
            UserVideo::query()
                ->where('request_id' , '=', $requestId)
                ->update([
                    'declined' => true
                ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param UserVideo $userVideo
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        UserVideo $userVideo
    ) : bool
    {
        try {
            return UserVideo::query()
                ->where('id', '=', $userVideo->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVideo.' . __FUNCTION__),
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
            return UserVideo::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
