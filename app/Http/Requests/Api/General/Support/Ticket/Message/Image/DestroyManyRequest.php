<?php

namespace App\Http\Requests\Api\General\Support\Ticket\Message\Image;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class DestroyManyRequest
 *
 * @package App\Http\Requests\Api\General\Support\Ticket\Message\Image
 */
class DestroyManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'support_ticket_message_images_ids'   => 'required|array',
            'support_ticket_message_images_ids.*' => 'required|integer|exists:support_ticket_message_images,id'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'support_ticket_message_images_ids.required'   => trans('validations/api/general/support/ticket/message/image/destroyMany.support_ticket_message_images_ids.required'),
            'support_ticket_message_images_ids.array'      => trans('validations/api/general/support/ticket/message/image/destroyMany.support_ticket_message_images_ids.array'),
            'support_ticket_message_images_ids.*.required' => trans('validations/api/general/support/ticket/message/image/destroyMany.support_ticket_message_images_ids.*.required'),
            'support_ticket_message_images_ids.*.integer'  => trans('validations/api/general/support/ticket/message/image/destroyMany.support_ticket_message_images_ids.*.integer'),
            'support_ticket_message_images_ids.*.exists'   => trans('validations/api/general/support/ticket/message/image/destroyMany.support_ticket_message_images_ids.*.exists')
        ];
    }
}
