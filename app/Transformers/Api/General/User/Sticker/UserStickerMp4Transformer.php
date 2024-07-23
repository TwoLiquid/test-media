<?php

namespace App\Transformers\Api\General\User\Sticker;

use App\Support\Response\Services\User\UserSticker\UserStickerMp4Response;
use App\Transformers\BaseTransformer;

/**
 * Class UserStickerMp4Transformer
 *
 * @package App\Transformers\Api\General\User\Sticker
 */
class UserStickerMp4Transformer extends BaseTransformer
{
    /**
     * @param UserStickerMp4Response $userStickerMp4
     *
     * @return array
     */
    public function transform(UserStickerMp4Response $userStickerMp4) : array
    {
        return [
            'url'        => $userStickerMp4->url,
            'duration'   => $userStickerMp4->duration,
            'dimensions' => $userStickerMp4->dimensions,
            'size'       => $userStickerMp4->size
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'mp4';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'mp4s';
    }
}
