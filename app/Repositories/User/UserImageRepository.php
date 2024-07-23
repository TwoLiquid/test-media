<?php

namespace App\Repositories\User;

use App\Exceptions\DatabaseException;
use App\Models\MySql\User\UserImage;
use App\Repositories\User\Interfaces\UserImageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class UserImageRepository
 *
 * @package App\Repositories\User
 */
class UserImageRepository implements UserImageRepositoryInterface
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
     * UserImageRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.userImage.perPage');
        $this->cacheTime = config('repositories.userImage.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return UserImage|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?UserImage
    {
        try {
            return UserImage::find($id);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $authId
     * @param int $id
     *
     * @return UserImage|null
     *
     * @throws DatabaseException
     */
    public function findForUser(
        int $authId,
        int $id
    ) : ?UserImage
    {
        try {
            return UserImage::query()
                ->where('auth_id', '=', $authId)
                ->where('id', '=', $id)
                ->first();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userImage.' . __FUNCTION__),
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
            return UserImage::all();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userImage.' . __FUNCTION__),
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
            return UserImage::query()
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userImage.' . __FUNCTION__),
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
            return UserImage::query()
                ->where('request_id', '=', $requestId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userImage.' . __FUNCTION__),
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
            return UserImage::query()
                ->whereIn('id', $ids ?? [])
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userImage.' . __FUNCTION__),
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
            return UserImage::query()
                ->where('auth_id', '=', $authId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userImage.' . __FUNCTION__),
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
            return UserImage::query()
                ->whereIn('auth_id', $authIds)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userImage.' . __FUNCTION__),
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
     * @return UserImage|null
     *
     * @throws DatabaseException
     */
    public function store(
        int $authId,
        ?string $requestId,
        string $url,
        string $mime,
        ?bool $declined = null
    ) : ?UserImage
    {
        try {
            return UserImage::create([
                'auth_id'    => $authId,
                'request_id' => $requestId,
                'url'        => trim($url),
                'mime'       => trim($mime),
                'declined'   => $declined,
                'likes'      => 0
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param UserImage $userImage
     * @param int|null $authId
     * @param string|null $requestId
     * @param string|null $url
     * @param string|null $mime
     * @param bool|null $declined
     *
     * @return UserImage
     *
     * @throws DatabaseException
     */
    public function update(
        UserImage $userImage,
        ?int $authId,
        ?string $requestId,
        ?string $url,
        ?string $mime,
        ?bool $declined
    ) : UserImage
    {
        try {
            $userImage->update([
                'auth_id'    => $authId ?: $userImage->auth_id,
                'request_id' => $requestId ?: $userImage->request_id,
                'url'        => $url ? trim($url) : $userImage->url,
                'mime'       => $mime ? trim($mime) : $userImage->mime,
                'declined'   => $declined ?: $userImage->declined
            ]);

            return $userImage;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param UserImage $userImage
     * @param int $likes
     *
     * @return UserImage
     *
     * @throws DatabaseException
     */
    public function updateLikes(
        UserImage $userImage,
        int $likes
    ) : UserImage
    {
        try {
            $userImage->update([
                'likes' => $likes
            ]);

            return $userImage;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userImage.' . __FUNCTION__),
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
            UserImage::query()
                ->where('request_id' , '=', $requestId)
                ->update([
                    'declined' => false
                ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userImage.' . __FUNCTION__),
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
            UserImage::query()
                ->where('request_id' , '=', $requestId)
                ->update([
                    'declined' => true
                ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param UserImage $userImage
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        UserImage $userImage
    ) : bool
    {
        try {
            return UserImage::query()
                ->where('id' , '=', $userImage->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userImage.' . __FUNCTION__),
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
            return UserImage::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
