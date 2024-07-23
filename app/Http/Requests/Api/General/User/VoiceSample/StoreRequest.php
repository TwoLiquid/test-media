<?php

namespace App\Http\Requests\Api\General\User\VoiceSample;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreRequest
 *
 * @package App\Http\Requests\Api\General\User\VoiceSample
 */
class StoreRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'request_id' => 'string|nullable',
            'content'    => 'required|string',
            'mime'       => 'required|string',
            'extension'  => 'required|string',
            'declined'   => 'boolean|nullable'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'request_id.string'  => trans('validations/api/general/user/voiceSample/store.request_id.string'),
            'content.required'   => trans('validations/api/general/user/voiceSample/store.content.required'),
            'content.string'     => trans('validations/api/general/user/voiceSample/store.content.string'),
            'mime.required'      => trans('validations/api/general/user/voiceSample/store.mime.required'),
            'mime.string'        => trans('validations/api/general/user/voiceSample/store.mime.string'),
            'extension.required' => trans('validations/api/general/user/voiceSample/store.extension.required'),
            'extension.string'   => trans('validations/api/general/user/voiceSample/store.extension.string'),
            'declined.boolean'   => trans('validations/api/general/user/voiceSample/store.declined.boolean')
        ];
    }
}
