<?php

namespace App\Transformers\Api\Guest\User;

use App\Models\MySql\User\UserVoiceSample;
use App\Transformers\BaseTransformer;

/**
 * Class UserVoiceSampleTransformer
 *
 * @package App\Transformers\Api\Guest\User
 */
class UserVoiceSampleTransformer extends BaseTransformer
{
    /**
     * @param UserVoiceSample $userVoiceSample
     *
     * @return array
     */
    public function transform(UserVoiceSample $userVoiceSample) : array
    {
        return [
            'id'           => $userVoiceSample->id,
            'auth_id'      => $userVoiceSample->auth_id,
            'request_id'   => $userVoiceSample->request_id,
            'url'          => generateFullStorageLink($userVoiceSample->url),
            'download_url' => route('api.user.voice.sample.download', [
                'id' => $userVoiceSample->id
            ]),
            'duration'     => $userVoiceSample->duration,
            'mime'         => $userVoiceSample->mime,
            'declined'     => $userVoiceSample->declined
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'user_voice_sample';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'user_voice_samples';
    }
}
