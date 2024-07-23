<?php

namespace App\Transformers\Api\General\User\Sticker;

use App\Support\Response\Services\User\UserSticker\UserStickerTinyMp4Response;
use App\Transformers\BaseTransformer;

/**
 * Class UserStickerTinyMp4Transformer
 *
 * @package App\Transformers\Api\General\User\Sticker
 */
class UserStickerTinyMp4Transformer extends BaseTransformer
{
    /**
     * @param UserStickerTinyMp4Response $userStickerTinyMp4
     *
     * @return array
     */
    public function transform(UserStickerTinyMp4Response $userStickerTinyMp4) : array
    {
        return [
            'url'        => $userStickerTinyMp4->url,
            'duration'   => $userStickerTinyMp4->duration,
            'dimensions' => $userStickerTinyMp4->dimensions,
            'size'       => $userStickerTinyMp4->size
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'tiny_mp4';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'tiny_mp4s';
    }
}
