<?php

namespace App\Transformers\Api\General\User\Sticker;

use App\Support\Response\Services\User\UserSticker\UserStickerTinyGifResponse;
use App\Transformers\BaseTransformer;

/**
 * Class UserStickerTinyGifTransformer
 *
 * @package App\Transformers\Api\General\User\Sticker
 */
class UserStickerTinyGifTransformer extends BaseTransformer
{
    /**
     * @param UserStickerTinyGifResponse $userStickerTinyGif
     *
     * @return array
     */
    public function transform(UserStickerTinyGifResponse $userStickerTinyGif) : array
    {
        return [
            'url'        => $userStickerTinyGif->url,
            'dimensions' => $userStickerTinyGif->dimensions,
            'size'       => $userStickerTinyGif->size
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'tiny_gif';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'tiny_gifs';
    }
}
