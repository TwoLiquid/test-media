<?php

namespace App\Support\Response\Services\User\UserSticker;

/**
 * Class UserStickerResponse
 *
 * @property string $id
 * @property string $title
 * @property UserStickerGifResponse $userStickerGif
 * @property UserStickerTinyGifResponse $userStickerTinyGif
 * @property UserStickerMp4Response $userStickerMp4
 * @property UserStickerTinyMp4Response $userStickerTinyMp4
 *
 * @package App\Support\Response\Services\User\UserSticker
 */
class UserStickerResponse extends BaseResponse
{
    /**
     * @var string
     */
    public string $id;

    /**
     * @var string|null
     */
    public ?string $title;

    /**
     * @var UserStickerGifResponse|null
     */
    public ?UserStickerGifResponse $userStickerGif;

    /**
     * @var UserStickerTinyGifResponse|null
     */
    public ?UserStickerTinyGifResponse $userStickerTinyGif;

    /**
     * @var UserStickerMp4Response|null
     */
    public ?UserStickerMp4Response $userStickerMp4;

    /**
     * @var UserStickerTinyMp4Response|null
     */
    public ?UserStickerTinyMp4Response $userStickerTinyMp4;

    /**
     * UserStickerCategoryResponse constructor
     *
     * @param object $response
     * @param string|null $message
     */
    public function __construct(
        object $response,
        ?string $message
    )
    {
        $this->id = $response->id;
        $this->title = $response->title;

        if (isset($response->media_formats)) {
            if (isset($response->media_formats->gif)) {
                $this->userStickerGif = new UserStickerGifResponse(
                    $response->media_formats->gif,
                    null
                );
            }

            if (isset($response->media_formats->tinygif)) {
                $this->userStickerTinyGif = new UserStickerTinyGifResponse(
                    $response->media_formats->tinygif,
                    null
                );
            }

            if (isset($response->media_formats->mp4)) {
                $this->userStickerMp4 = new UserStickerMp4Response(
                    $response->media_formats->mp4,
                    null
                );
            }

            if (isset($response->media_formats->tinymp4)) {
                $this->userStickerTinyMp4 = new UserStickerTinyMp4Response(
                    $response->media_formats->tinymp4,
                    null
                );
            }
        }

        parent::__construct($message);
    }
}
