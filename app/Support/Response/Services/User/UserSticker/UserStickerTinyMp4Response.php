<?php

namespace App\Support\Response\Services\User\UserSticker;

/**
 * Class UserStickerTinyMp4Response
 *
 * @property string $url
 * @property int $duration
 * @property array $dimensions
 * @property int $size
 *
 * @package App\Support\Response\Services\User\UserSticker
 */
class UserStickerTinyMp4Response extends BaseResponse
{
    /**
     * @var string
     */
    public string $url;

    /**
     * @var int
     */
    public int $duration;

    /**
     * @var array
     */
    public array $dimensions;

    /**
     * @var int
     */
    public int $size;

    /**
     * UserStickerTinyMp4Response constructor
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
        $this->duration = $response->duration;
        $this->dimensions = $response->dims;
        $this->size = $response->size;

        parent::__construct($message);
    }
}
