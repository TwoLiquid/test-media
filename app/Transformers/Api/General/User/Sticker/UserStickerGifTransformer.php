<?php

namespace App\Transformers\Api\General\User\Sticker;

use App\Support\Response\Services\User\UserSticker\UserStickerGifResponse;
use App\Transformers\BaseTransformer;

/**
 * Class UserStickerGifTransformer
 *
 * @package App\Transformers\Api\General\User\Sticker
 */
class UserStickerGifTransformer extends BaseTransformer
{
    /**
     * @param UserStickerGifResponse $userStickerGif
     *
     * @return array
     */
    public function transform(UserStickerGifResponse $userStickerGif) : array
    {
        return [
            'url'        => $userStickerGif->url,
            'dimensions' => $userStickerGif->dimensions,
            'size'       => $userStickerGif->size
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'gif';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'gifs';
    }
}
