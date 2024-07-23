<?php

namespace App\Configs\Audio\Chat\Message;

use App\Configs\Audio\BaseAudioConfig;

/**
 * Class ChatMessageAudioConfig
 *
 * @package App\Configs\Audio\Chat\Message
 */
abstract class ChatMessageAudioConfig extends BaseAudioConfig
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
