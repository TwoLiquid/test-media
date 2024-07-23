<?php

namespace App\Transformers\Api\General\Alert;

use App\Models\MySql\Alert\AlertSound;
use App\Transformers\BaseTransformer;

/**
 * Class AlertSoundTransformer
 *
 * @package App\Transformers\Api\General\Alert
 */
class AlertSoundTransformer extends BaseTransformer
{
    /**
     * @param AlertSound $alertSound
     *
     * @return array
     */
    public function transform(AlertSound $alertSound) : array
    {
        return [
            'id'       => $alertSound->id,
            'alert_id' => $alertSound->alert_id,
            'url'      => generateFullStorageLink($alertSound->url),
            'duration' => $alertSound->duration,
            'mime'     => $alertSound->mime,
            'active'   => $alertSound->active
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'alert_sound';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'alert_sounds';
    }
}
