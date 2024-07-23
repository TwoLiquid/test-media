<?php

namespace App\Configs\Image\Support\Ticket\Message;

use App\Configs\Image\BaseImageConfig;

/**
 * Class SupportTicketMessageImageConfig
 *
 * @package App\Configs\Image\Support\Ticket\Message
 */
abstract class SupportTicketMessageImageConfig extends BaseImageConfig
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
