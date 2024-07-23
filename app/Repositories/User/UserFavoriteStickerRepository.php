<?php

namespace App\Repositories\User;

use App\Exceptions\DatabaseException;
use App\Models\MySql\User\UserFavoriteSticker;
use App\Repositories\User\Interfaces\UserFavoriteStickerRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class UserFavoriteStickerRepository
 *
 * @package App\Repositories\User
 */
class UserFavoriteStickerRepository implements UserFavoriteStickerRepositoryInterface
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
     * UserFavoriteStickerRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.userFavoriteSticker.perPage');
        $this->cacheTime = config('repositories.userFavoriteSticker.cacheTime');
    }

    /**
     * @param int $authId
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getAllForUser(
        int $authId
    ) : Collection
    {
        try {
            return UserFavoriteSticker::query()
                ->where('auth_id', '=', $authId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userFavoriteSticker.' . __FUNCTION__),
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
    public function getAllForUserPaginated(
        int $authId,
        ?int $page = null
    ) : LengthAwarePaginator
    {
        try {
            return UserFavoriteSticker::query()
                ->where('auth_id', '=', $authId)
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userFavoriteSticker.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $authId
     * @param string $externalId
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function checkForUserExistence(
        int $authId,
        string $externalId
    ) : bool
    {
        try {
            return UserFavoriteSticker::query()
                ->where('auth_id', '=', $authId)
                ->where('external_id', '=', $externalId)
                ->exists();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userFavoriteSticker.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $authId
     * @param string $externalId
     *
     * @return UserFavoriteSticker|null
     *
     * @throws DatabaseException
     */
    public function store(
        int $authId,
        string $externalId
    ) : ?UserFavoriteSticker
    {
        try {
            return UserFavoriteSticker::create([
                'auth_id'     => $authId,
                'external_id' => $externalId
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userFavoriteSticker.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $authId
     * @param string $externalId
     *
     * @return bool|null
     *
     * @throws DatabaseException
     */
    public function deleteForUser(
        int $authId,
        string $externalId
    ) : ?bool
    {
        try {
            return UserFavoriteSticker::query()
                ->where('auth_id', '=', $authId)
                ->where('external_id', '=', $externalId)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userFavoriteSticker.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $authId
     *
     * @return bool|null
     *
     * @throws DatabaseException
     */
    public function deleteAllForUser(
        int $authId
    ) : ?bool
    {
        try {
            return UserFavoriteSticker::query()
                ->where('auth_id', '=', $authId)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/user/userFavoriteSticker.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
