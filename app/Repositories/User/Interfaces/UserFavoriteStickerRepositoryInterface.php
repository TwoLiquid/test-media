<?php

namespace App\Repositories\User\Interfaces;

use App\Models\MySql\User\UserFavoriteSticker;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface UserFavoriteStickerRepositoryInterface
 *
 * @package App\Repositories\User\Interfaces
 */
interface UserFavoriteStickerRepositoryInterface
{
    /**
     * This method provides getting all rows
     * with an eloquent model
     *
     * @param int $authId
     *
     * @return Collection
     */
    public function getAllForUser(
        int $authId
    ) : Collection;

    /**
     * This method provides getting all rows
     * with an eloquent model
     *
     * @param int $authId
     * @param int|null $page
     *
     * @return LengthAwarePaginator
     */
    public function getAllForUserPaginated(
        int $authId,
        ?int $page
    ) : LengthAwarePaginator;

    /**
     * This method provides checking row existence
     * with an eloquent model
     *
     * @param int $authId
     * @param string $externalId
     *
     * @return bool
     */
    public function checkForUserExistence(
        int $authId,
        string $externalId
    ) : bool;

    /**
     * This method provides creating a new row
     * with an eloquent model
     *
     * @param int $authId
     * @param string $externalId
     *
     * @return UserFavoriteSticker|null
     */
    public function store(
        int $authId,
        string $externalId
    ) : ?UserFavoriteSticker;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param int $authId
     * @param string $externalId
     *
     * @return bool|null
     */
    public function deleteForUser(
        int $authId,
        string $externalId
    ) : ?bool;

    /**
     * This method provides deleting existing rows
     * with an eloquent model
     *
     * @param int $authId
     *
     * @return bool|null
     */
    public function deleteAllForUser(
        int $authId
    ) : ?bool;
}
