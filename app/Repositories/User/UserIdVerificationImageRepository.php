<?php

namespace App\Repositories\User;

use App\Exceptions\DatabaseException;
use App\Models\MySql\User\UserIdVerificationImage;
use App\Repositories\User\Interfaces\UserIdVerificationImageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class UserIdVerificationImageRepository
 *
 * @package App\Repositories\User
 */
class UserIdVerificationImageRepository implements UserIdVerificationImageRepositoryInterface
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
     * UserIdVerificationImageRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.userIdVerificationImage.perPage');
        $this->cacheTime = config('repositories.userIdVerificationImage.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return UserIdVerificationImage|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?UserIdVerificationImage
    {
        try {
            return UserIdVerificationImage::find($id);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userIdVerificationImage.' . __FUNCTION__),
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
            return UserIdVerificationImage::get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userIdVerificationImage.' . __FUNCTION__),
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
            return UserIdVerificationImage::query()
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userIdVerificationImage.' . __FUNCTION__),
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
    public function getAllForRequest(
        string $requestId
    ) : Collection
    {
        try {
            return UserIdVerificationImage::query()
                ->where('request_id', '=', $requestId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userIdVerificationImage.' . __FUNCTION__),
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
            return UserIdVerificationImage::query()
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userIdVerificationImage.' . __FUNCTION__),
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
            return UserIdVerificationImage::query()
                ->where('auth_id', '=', $authId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userIdVerificationImage.' . __FUNCTION__),
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
            return UserIdVerificationImage::query()
                ->whereIn('auth_id', $authIds)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userIdVerificationImage.' . __FUNCTION__),
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
    public function getDeclinedForUser(
        int $authId
    ) : Collection
    {
        try {
            return UserIdVerificationImage::query()
                ->where('auth_id', '=', $authId)
                ->where('declined', '=', true)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userIdVerificationImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $authId
     * @param string $requestId
     * @param string $url
     * @param string $mime
     * @param bool|null $declined
     *
     * @return UserIdVerificationImage|null
     *
     * @throws DatabaseException
     */
    public function store(
        int $authId,
        string $requestId,
        string $url,
        string $mime,
        ?bool $declined = null
    ) : ?UserIdVerificationImage
    {
        try {
            return UserIdVerificationImage::create([
                'auth_id'    => $authId,
                'request_id' => $requestId,
                'url'        => trim($url),
                'mime'       => trim($mime),
                'declined'   => $declined
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userIdVerificationImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param UserIdVerificationImage $userIdVerificationImage
     * @param int|null $authId
     * @param string|null $requestId
     * @param string|null $url
     * @param string|null $mime
     * @param bool|null $declined
     *
     * @return UserIdVerificationImage
     *
     * @throws DatabaseException
     */
    public function update(
        UserIdVerificationImage $userIdVerificationImage,
        ?int $authId,
        ?string $requestId,
        ?string $url,
        ?string $mime,
        ?bool $declined
    ) : UserIdVerificationImage
    {
        try {
            $userIdVerificationImage->update([
                'auth_id'    => $authId ?: $userIdVerificationImage->auth_id,
                'request_id' => $requestId ?: $userIdVerificationImage->request_id,
                'url'        => $url ? trim($url) : $userIdVerificationImage->url,
                'mime'       => $mime ? trim($mime) : $userIdVerificationImage->mime,
                'declined'   => $declined ?: $userIdVerificationImage->declined
            ]);

            return $userIdVerificationImage;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userIdVerificationImage.' . __FUNCTION__),
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
            UserIdVerificationImage::query()
                ->where('request_id', '=', $requestId)
                ->update([
                    'declined' => true
                ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userIdVerificationImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param UserIdVerificationImage $userIdVerificationImage
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        UserIdVerificationImage $userIdVerificationImage
    ) : bool
    {
        try {
            return UserIdVerificationImage::query()
                ->where('id', '=', $userIdVerificationImage->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userIdVerificationImage.' . __FUNCTION__),
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
            return UserIdVerificationImage::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userIdVerificationImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
