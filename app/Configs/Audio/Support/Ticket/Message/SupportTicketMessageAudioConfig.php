<?php

namespace App\Configs\Audio\Support\Ticket\Message;

use App\Configs\Audio\BaseAudioConfig;

/**
 * Class SupportTicketMessageAudioConfig
 *
 * @package App\Configs\Audio\Support\Ticket\Message
 */
abstract class SupportTicketMessageAudioConfig extends BaseAudioConfig
{
    /**
     * List of allowed mimes
     *
     * @var array
     */
    protected const ALLOWED_MIMES = [
        'audio/mpeg',
        'audio/mp4',
        'video/ogg',
        'audio/webm',
        'audio/vnd.wave',
        'audio/x-wav'
    ];

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
