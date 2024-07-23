<?php

namespace App\Configs\Icon\Category;

use App\Configs\Icon\BaseIconConfig;

/**
 * Class CategoryIconConfig
 *
 * @package App\Configs\Icon\Category
 */
abstract class CategoryIconConfig extends BaseIconConfig
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
