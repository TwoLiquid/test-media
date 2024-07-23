<?php

namespace App\Configs;

/**
 * Class BaseConfig
 *
 * @package App\Configs
 */
abstract class BaseConfig
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
    protected const MAXIMUM_SIZE = 0;

    /**
     * @return array
     */
    public static function getAllowedMimes() : array
    {
        return static::ALLOWED_MIMES;
    }

    /**
     * @return int
     */
    public static function getMinimumSize() : int
    {
        return static::MINIMUM_SIZE;
    }

    /**
     * @return int
     */
    public static function getMaximumSize() : int
    {
        return static::MAXIMUM_SIZE;
    }

    /**
     * @param string $mime
     *
     * @return bool
     */
    public static function isMimeAllowed(
        string $mime
    ) : bool
    {
        if (empty(static::ALLOWED_MIMES) ||
            in_array(trim($mime), static::ALLOWED_MIMES)
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param int $size
     *
     * @return bool
     */
    public static function isMinimumSizeAllowed(
        int $size
    ) : bool
    {
        return $size >= static::MINIMUM_SIZE;
    }

    /**
     * @param int $size
     *
     * @return bool
     */
    public static function isMaximumSizeAllowed(
        int $size
    ) : bool
    {
        return $size <= static::MAXIMUM_SIZE;
    }
}
