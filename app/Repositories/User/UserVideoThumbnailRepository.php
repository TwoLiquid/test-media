<?php

namespace App\Repositories\User;

use App\Exceptions\DatabaseException;
use App\Models\MySql\User\UserVideo;
use App\Models\MySql\User\UserVideoThumbnail;
use App\Repositories\User\Interfaces\UserVideoThumbnailRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class UserVideoThumbnailRepository
 *
 * @package App\Repositories\User
 */
class UserVideoThumbnailRepository implements UserVideoThumbnailRepositoryInterface
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
     * UserVideoThumbnailRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.userVideoThumbnail.perPage');
        $this->cacheTime = config('repositories.userVideoThumbnail.cacheTime');
    }

    /**
     * @param int $authId
     * @param int $id
     *
     * @return UserVideoThumbnail|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $authId,
        int $id
    ) : ?UserVideoThumbnail
    {
        try {
            return UserVideoThumbnail::query()
                ->where('auth_id', '=', $authId)
                ->where('id', '=', $id)
                ->first();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVideoThumbnail.' . __FUNCTION__),
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
    public function getAll(
        int $authId
    ) : Collection
    {
        try {
            return UserVideoThumbnail::query()
                ->where('auth_id', '=', $authId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVideoThumbnail.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $authId
     * @param int|null $page
     *
     * @return LengthAwarePaginator
     *
     * @throws DatabaseException
     */
    public function getAllPaginated(
        int $authId,
        ?int $page = null
    ) : LengthAwarePaginator
    {
        try {
            return UserVideoThumbnail::query()
                ->where('auth_id', '=', $authId)
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVideoThumbnail.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $authId
     * @param array $userVideoThumbnailsIds
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getByIds(
        int $authId,
        array $userVideoThumbnailsIds
    ) : Collection
    {
        try {
            return UserVideoThumbnail::query()
                ->where('auth_id', '=', $authId)
                ->whereIn('id', $userVideoThumbnailsIds)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVideoThumbnail.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param UserVideo $userVideo
     * @param string $url
     * @param string $mime
     *
     * @return UserVideoThumbnail|null
     *
     * @throws DatabaseException
     */
    public function store(
        UserVideo $userVideo,
        string $url,
        string $mime
    ) : ?UserVideoThumbnail
    {
        try {
            return UserVideoThumbnail::create([
                'video_id' => $userVideo->id,
                'url'      => trim($url),
                'mime'     => trim($mime)
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVideoThumbnail.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param UserVideoThumbnail $userVideoThumbnail
     * @param UserVideo|null $userVideo
     * @param string|null $url
     * @param string|null $mime
     *
     * @return UserVideoThumbnail
     *
     * @throws DatabaseException
     */
    public function update(
        UserVideoThumbnail $userVideoThumbnail,
        ?UserVideo $userVideo,
        ?string $url,
        ?string $mime
    ) : UserVideoThumbnail
    {
        try {
            $userVideoThumbnail->update([
                'video_id' => $userVideo ? $userVideo->id : $userVideoThumbnail->video_id,
                'url'      => $url ? trim($url) : $userVideoThumbnail->url,
                'mime'     => $mime ? trim($mime) : $userVideoThumbnail->mime
            ]);

            return $userVideoThumbnail;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVideoThumbnail.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $authId
     * @param UserVideoThumbnail $userVideoThumbnail
     *
     * @return bool|null
     *
     * @throws DatabaseException
     */
    public function delete(
        int $authId,
        UserVideoThumbnail $userVideoThumbnail
    ) : ?bool
    {
        try {
            return UserVideoThumbnail::query()
                ->where('auth_id', '=', $authId)
                ->where('id' , '=', $userVideoThumbnail->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVideoThumbnail.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array $userVideosIds
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function deleteByVideosIds(
        array $userVideosIds
    ) : bool
    {
        try {
            return UserVideoThumbnail::query()
                ->whereIn('video_id', $userVideosIds)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVideoThumbnail.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $authId
     * @param array $userVideoThumbnailsIds
     *
     * @return bool|null
     *
     * @throws DatabaseException
     */
    public function deleteByIds(
        int $authId,
        array $userVideoThumbnailsIds
    ) : ?bool
    {
        try {
            return UserVideoThumbnail::query()
                ->where('auth_id', '=', $authId)
                ->whereIn('id', $userVideoThumbnailsIds)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userVideoThumbnail.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
