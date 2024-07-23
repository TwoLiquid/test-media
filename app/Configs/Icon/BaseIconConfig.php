<?php

namespace App\Configs\Icon;

use App\Configs\BaseConfig;

/**
 * Class BaseIconConfig
 *
 * @package App\Configs\Icon
 */
abstract class BaseIconConfig extends BaseConfig
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
    protected const MAXIMUM_SIZE = 1000;
}
