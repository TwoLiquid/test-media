<?php

namespace App\Configs\Document\Chat\Message;

use App\Configs\Document\BaseDocumentConfig;

/**
 * Class ChatMessageDocumentConfig
 *
 * @package App\Configs\Document\Chat\Message
 */
abstract class ChatMessageDocumentConfig extends BaseDocumentConfig
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
