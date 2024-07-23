<?php

namespace App\Configs\Icon\Device;

use App\Configs\Icon\BaseIconConfig;

/**
 * Class DeviceIconConfig
 *
 * @package App\Configs\Icon\Device
 */
abstract class DeviceIconConfig extends BaseIconConfig
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
