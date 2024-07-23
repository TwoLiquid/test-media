<?php

namespace App\Support\Response\Services\User\UserSticker;

/**
 * Class UserStickerTinyGifResponse
 *
 * @property string $url
 * @property array $dimensions
 * @property int $size
 *
 * @package App\Support\Response\Services\User\UserSticker
 */
class UserStickerTinyGifResponse extends BaseResponse
{
    /**
     * @var string
     */
    public string $url;

    /**
     * @var array
     */
    public array $dimensions;

    /**
     * @var int
     */
    public int $size;

    /**
     * UserStickerTinyGifResponse constructor
     *
     * @param object $response
     * @param string|null $message
     */
    public function __construct(
        object $response,
        ?string $message
    )
    {
        $this->url = $response->url;
        $this->dimensions = $response->dims;
        $this->size = $response->size;

        parent::__construct($message);
    }
}
