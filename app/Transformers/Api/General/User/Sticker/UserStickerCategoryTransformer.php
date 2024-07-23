<?php

namespace App\Transformers\Api\General\User\Sticker;

use App\Support\Response\Services\User\UserSticker\UserStickerCategoryResponse;
use App\Transformers\BaseTransformer;

/**
 * Class UserStickerCategoryTransformer
 *
 * @package App\Transformers\Api\General\User\Sticker
 */
class UserStickerCategoryTransformer extends BaseTransformer
{
    /**
     * @param UserStickerCategoryResponse $userStickerCategory
     *
     * @return array
     */
    public function transform(UserStickerCategoryResponse $userStickerCategory) : array
    {
        return [
            'tag' => $userStickerCategory->tag,
            'url' => $userStickerCategory->url
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'user_sticker_category';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'user_sticker_categories';
    }
}
