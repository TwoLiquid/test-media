<?php

namespace App\Http\Requests\Api\General\Support\Ticket\Message\Document;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreRequest
 *
 * @package App\Http\Requests\Api\General\Support\Ticket\Message\Document
 */
class StoreRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'content'       => 'required|string',
            'original_name' => 'string|nullable',
            'extension'     => 'required|string',
            'mime'          => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'content.required'     => trans('validations/api/general/support/ticket/message/document/store.content.required'),
            'content.string'       => trans('validations/api/general/support/ticket/message/document/store.content.string'),
            'original_name.string' => trans('validations/api/general/support/ticket/message/document/store.original_name.string'),
            'extension.required'   => trans('validations/api/general/support/ticket/message/document/store.extension.required'),
            'extension.string'     => trans('validations/api/general/support/ticket/message/document/store.extension.string'),
            'mime.required'        => trans('validations/api/general/support/ticket/message/document/store.mime.required'),
            'mime.string'          => trans('validations/api/general/support/ticket/message/document/store.mime.string')
        ];
    }
}
