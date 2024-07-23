<?php

namespace App\Configs\Audio\Alert;

use App\Configs\Audio\BaseAudioConfig;

/**
 * Class AlertSoundConfig
 * 
 * @package App\Configs\Audio\Alert
 */
abstract class AlertSoundConfig extends BaseAudioConfig
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
