<?php

namespace App\Transformers\Api\General\User\Sticker;

use App\Support\Response\Services\User\UserSticker\UserStickerCollectionResponse;
use App\Transformers\BaseTransformer;

/**
 * Class UserStickerNextTransformer
 *
 * @package App\Transformers\Api\General\User\Sticker
 */
class UserStickerNextTransformer extends BaseTransformer
{
    /**
     * @param UserStickerCollectionResponse $userStickerCollection
     *
     * @return array
     */
    public function transform(UserStickerCollectionResponse $userStickerCollection) : array
    {
        return [
            'next' => $userStickerCollection->next
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'next';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'next';
    }
}
