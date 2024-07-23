<?php

namespace App\Support\Response\Services\User\UserSticker;

/**
 * Class BaseResponse
 *
 * @property string $message
 *
 * @package App\Support\Response\Services\User\UserSticker
 */
class BaseResponse
{
    /**
     * @var string|null
     */
    public ?string $message;

    /**
     * BaseResponse constructor
     *
     * @param string|null $message
     */
    public function __construct(
        ?string $message
    )
    {
        $this->message = $message;
    }
}
