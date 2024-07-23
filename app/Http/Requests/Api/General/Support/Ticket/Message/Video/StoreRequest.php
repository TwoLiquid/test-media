<?php

namespace App\Http\Requests\Api\General\Support\Ticket\Message\Video;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreRequest
 *
 * @package App\Http\Requests\Api\General\Support\Ticket\Message\Video
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
            'extension' => 'required|string',
            'mime'      => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'content.required'   => trans('validations/api/general/support/ticket/message/video/store.content.required'),
            'content.string'     => trans('validations/api/general/support/ticket/message/video/store.content.string'),
            'extension.required' => trans('validations/api/general/support/ticket/message/video/store.extension.required'),
            'extension.string'   => trans('validations/api/general/support/ticket/message/video/store.extension.string'),
            'mime.required'      => trans('validations/api/general/support/ticket/message/video/store.mime.required'),
            'mime.string'        => trans('validations/api/general/support/ticket/message/video/store.mime.string')
        ];
    }
}
