<?php

namespace App\Transformers\Api\General\User\Sticker;

use App\Support\Response\Services\User\UserSticker\UserStickerResponse;
use App\Transformers\BaseTransformer;
use League\Fractal\Resource\Item;

/**
 * Class UserStickerTransformer
 *
 * @package App\Transformers\Api\General\User\Sticker
 */
class UserStickerTransformer extends BaseTransformer
{
    /**
     * @var array
     */
    protected array $defaultIncludes = [
        'gif',
        'tiny_gif',
        'mp4',
        'tiny_mp4'
    ];

    /**
     * @param UserStickerResponse $userSticker
     *
     * @return array
     */
    public function transform(UserStickerResponse $userSticker) : array
    {
        return [
            'id'    => $userSticker->id,
            'title' => $userSticker->title
        ];
    }

    /**
     * @param UserStickerResponse $userSticker
     *
     * @return Item|null
     */
    public function includeGif(UserStickerResponse $userSticker): ?Item
    {
        $userStickerGif = $userSticker->userStickerGif;

        return $userStickerGif ? $this->item($userStickerGif, new UserStickerGifTransformer) : null;
    }

    /**
     * @param UserStickerResponse $userSticker
     *
     * @return Item|null
     */
    public function includeTinyGif(UserStickerResponse $userSticker): ?Item
    {
        $userStickerTinyGif = $userSticker->userStickerTinyGif;

        return $userStickerTinyGif ? $this->item($userStickerTinyGif, new UserStickerTinyGifTransformer) : null;
    }

    /**
     * @param UserStickerResponse $userSticker
     *
     * @return Item|null
     */
    public function includeMp4(UserStickerResponse $userSticker): ?Item
    {
        $userStickerMp4 = $userSticker->userStickerMp4;

        return $userStickerMp4 ? $this->item($userStickerMp4, new UserStickerMp4Transformer) : null;
    }

    /**
     * @param UserStickerResponse $userSticker
     *
     * @return Item|null
     */
    public function includeTinyMp4(UserStickerResponse $userSticker): ?Item
    {
        $userStickerTinyMp4 = $userSticker->userStickerTinyMp4;

        return $userStickerTinyMp4 ? $this->item($userStickerTinyMp4, new UserStickerTinyMp4Transformer) : null;
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'user_sticker';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'user_stickers';
    }
}
