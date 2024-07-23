<?php

namespace App\Http\Requests\Api\General\Chat\Message\Audio;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreRequest
 *
 * @package App\Http\Requests\Api\General\Chat\Message\Audio
 */
class StoreRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'content'   => 'required|string',
            'mime'      => 'required|string',
            'extension' => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'content.required'   => trans('validations/api/general/chat/message/audio/store.content.required'),
            'content.string'     => trans('validations/api/general/chat/message/audio/store.content.string'),
            'mime.required'      => trans('validations/api/general/chat/message/audio/store.mime.required'),
            'mime.string'        => trans('validations/api/general/chat/message/audio/store.mime.string'),
            'extension.required' => trans('validations/api/general/chat/message/audio/store.extension.required'),
            'extension.string'   => trans('validations/api/general/chat/message/audio/store.extension.string')
        ];
    }
}
