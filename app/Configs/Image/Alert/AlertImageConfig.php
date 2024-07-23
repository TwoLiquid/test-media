<?php

namespace App\Configs\Image\Alert;

use App\Configs\Image\BaseImageConfig;

/**
 * Class AlertImageConfig
 *
 * @package App\Configs\Image\Alert
 */
abstract class AlertImageConfig extends BaseImageConfig
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
