<?php

namespace App\Configs\Icon\Platform;

use App\Configs\Icon\BaseIconConfig;

/**
 * Class PlatformIconConfig
 *
 * @package App\Configs\Icon\Platform
 */
abstract class PlatformIconConfig extends BaseIconConfig
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
