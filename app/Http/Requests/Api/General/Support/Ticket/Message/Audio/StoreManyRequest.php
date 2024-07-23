<?php

namespace App\Http\Requests\Api\General\Support\Ticket\Message\Audio;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreManyRequest
 *
 * @package App\Http\Requests\Api\General\Support\Ticket\Message\Audio
 */
class StoreManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'support_ticket_message_audios'             => 'required|array',
            'support_ticket_message_audios.*.content'   => 'required|string',
            'support_ticket_message_audios.*.mime'      => 'required|string',
            'support_ticket_message_audios.*.extension' => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'support_ticket_message_audios.required'             => trans('validations/api/general/support/ticket/message/audio/storeMany.support_ticket_message_audios.required'),
            'support_ticket_message_audios.array'                => trans('validations/api/general/support/ticket/message/audio/storeMany.support_ticket_message_audios.array'),
            'support_ticket_message_audios.*.content.required'   => trans('validations/api/general/support/ticket/message/audio/storeMany.support_ticket_message_audios.*.content.required'),
            'support_ticket_message_audios.*.content.string'     => trans('validations/api/general/support/ticket/message/audio/storeMany.support_ticket_message_audios.*.content.string'),
            'support_ticket_message_audios.*.mime.required'      => trans('validations/api/general/support/ticket/message/audio/storeMany.support_ticket_message_audios.*.mime.required'),
            'support_ticket_message_audios.*.mime.string'        => trans('validations/api/general/support/ticket/message/audio/storeMany.support_ticket_message_audios.*.mime.string'),
            'support_ticket_message_audios.*.extension.required' => trans('validations/api/general/support/ticket/message/audio/storeMany.support_ticket_message_audios.*.extension.required'),
            'support_ticket_message_audios.*.extension.string'   => trans('validations/api/general/support/ticket/message/audio/storeMany.support_ticket_message_audios.*.extension.string')
        ];
    }
}
