<?php

namespace App\Configs\Image;

use App\Configs\BaseConfig;

/**
 * Class BaseImageConfig
 *
 * @package App\Configs\Image
 */
abstract class BaseImageConfig extends BaseConfig
{
    /**
     * List of allowed mimes
     *
     * @var array
     */
    protected const ALLOWED_MIMES = [
        'image/png',
        'image/jpeg',
        'image/gif'
    ];

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
