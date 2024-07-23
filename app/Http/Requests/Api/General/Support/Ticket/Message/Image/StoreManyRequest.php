<?php

namespace App\Http\Requests\Api\General\Support\Ticket\Message\Image;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreManyRequest
 *
 * @package App\Http\Requests\Api\General\Support\Ticket\Message\Image
 */
class StoreManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'support_ticket_message_images'             => 'required|array',
            'support_ticket_message_images.*.content'   => 'required|string',
            'support_ticket_message_images.*.extension' => 'required|string',
            'support_ticket_message_images.*.mime'      => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'support_ticket_message_images.required'             => trans('validations/api/general/support/ticket/message/image/storeMany.support_ticket_message_images.required'),
            'support_ticket_message_images.array'                => trans('validations/api/general/support/ticket/message/image/storeMany.support_ticket_message_images.array'),
            'support_ticket_message_images.*.content.required'   => trans('validations/api/general/support/ticket/message/image/storeMany.support_ticket_message_images.*.content.required'),
            'support_ticket_message_images.*.content.string'     => trans('validations/api/general/support/ticket/message/image/storeMany.support_ticket_message_images.*.content.string'),
            'support_ticket_message_images.*.extension.required' => trans('validations/api/general/support/ticket/message/image/storeMany.support_ticket_message_images.*.extension.required'),
            'support_ticket_message_images.*.extension.string'   => trans('validations/api/general/support/ticket/message/image/storeMany.support_ticket_message_images.*.extension.string'),
            'support_ticket_message_images.*.mime.required'      => trans('validations/api/general/support/ticket/message/image/storeMany.support_ticket_message_images.*.mime.required'),
            'support_ticket_message_images.*.mime.string'        => trans('validations/api/general/support/ticket/message/image/storeMany.support_ticket_message_images.*.mime.string')
        ];
    }
}
