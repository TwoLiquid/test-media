<?php

namespace App\Configs\Document\Support\Ticket\Message;

use App\Configs\Document\BaseDocumentConfig;

/**
 * Class SupportTicketMessageDocumentConfig
 *
 * @package App\Configs\Document\Support\Ticket\Message
 */
abstract class SupportTicketMessageDocumentConfig extends BaseDocumentConfig
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
