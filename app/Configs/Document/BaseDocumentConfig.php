<?php

namespace App\Configs\Document;

use App\Configs\BaseConfig;

/**
 * Class BaseDocumentConfig
 *
 * @package App\Configs\Document
 */
abstract class BaseDocumentConfig extends BaseConfig
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
