<?php

namespace App\Configs\Image\Admin;

use App\Configs\Image\BaseImageConfig;

/**
 * Class AdminAvatarConfig
 *
 * @package App\Configs\Image\Admin
 */
abstract class AdminAvatarConfig extends BaseImageConfig
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
