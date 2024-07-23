<?php

namespace App\Services\User\Interfaces;

use App\Support\Response\Services\User\UserSticker\UserStickerCategoryCollectionResponse;
use App\Support\Response\Services\User\UserSticker\UserStickerCollectionResponse;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface UserStickerServiceInterface
 *
 * @package App\Services\User\Interfaces
 */
interface UserStickerServiceInterface
{
    /**
     * This method provides getting data
     *
     * @param string $type
     *
     * @return UserStickerCategoryCollectionResponse
     */
    public function getCategories(
        string $type
    ) : UserStickerCategoryCollectionResponse;

    /**
     * This method provides getting data
     *
     * @param int $limit
     * @param string|null $next
     *
     * @return UserStickerCollectionResponse
     */
    public function getFeatured(
        int $limit,
        ?string $next
    ) : UserStickerCollectionResponse;

    /**
     * This method provides getting data
     *
     * @param string $query
     * @param int $limit
     * @param string|null $next
     *
     * @return UserStickerCollectionResponse
     */
    public function searchByQuery(
        string $query,
        int $limit,
        ?string $next
    ) : UserStickerCollectionResponse;

    /**
     * This method provides getting data
     *
     * @param Collection $userFavoriteStickers
     *
     * @return UserStickerCollectionResponse
     */
    public function getFavorites(
        Collection $userFavoriteStickers
    ) : UserStickerCollectionResponse;

    /**
     * @param array $ids
     *
     * @return UserStickerCollectionResponse
     */
    public function getByIds(
        array $ids
    ) : UserStickerCollectionResponse;
}
