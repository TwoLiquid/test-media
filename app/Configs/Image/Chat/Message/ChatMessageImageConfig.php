<?php

namespace App\Configs\Image\Chat\Message;

use App\Configs\Image\BaseImageConfig;

/**
 * Class ChatMessageImageConfig
 *
 * @package App\Configs\Image\Chat\Message
 */
abstract class ChatMessageImageConfig extends BaseImageConfig
{
    /**
     * List of allowed mimes
     *
     * @var array
     */
    protected const ALLOWED_MIMES = [];

    /**
     * Minimum file size
     *
     * @var int
     */
    protected const MINIMUM_SIZE = 0;

    /**
     * Maximum file size
     *
     * @var int
     */
    protected const MAXIMUM_SIZE = 20000;
}
