<?php

namespace App\Configs\Image\Activity;

use App\Configs\Image\BaseImageConfig;

/**
 * Class ActivityImageConfig
 *
 * @package App\Configs\Image\Activity
 */
abstract class ActivityImageConfig extends BaseImageConfig
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
