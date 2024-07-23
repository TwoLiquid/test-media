<?php

namespace App\Configs\Image\Review\Message;

use App\Configs\Image\BaseImageConfig;

/**
 * Class ReviewMessageImageConfig
 *
 * @package App\Configs\Image\Review\Message
 */
abstract class ReviewMessageImageConfig extends BaseImageConfig
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
