<?php

namespace App\Support\Response\Services\User\UserSticker;

/**
 * Class UserStickerCategoryResponse
 *
 * @property string $tag
 * @property string $url
 *
 * @package App\Support\Response\Services\User\UserSticker
 */
class UserStickerCategoryResponse extends BaseResponse
{
    /**
     * @var string
     */
    public string $tag;

    /**
     * @var string
     */
    public string $url;

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
        $this->tag = $response->searchterm;
        $this->url = $response->image;

        parent::__construct($message);
    }
}
