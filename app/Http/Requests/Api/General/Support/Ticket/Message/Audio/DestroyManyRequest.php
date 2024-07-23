<?php

namespace App\Http\Requests\Api\General\Support\Ticket\Message\Audio;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class DestroyManyRequest
 *
 * @package App\Http\Requests\Api\General\Support\Ticket\Message\Audio
 */
class DestroyManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'support_ticket_message_audios_ids'   => 'required|array',
            'support_ticket_message_audios_ids.*' => 'required|integer|exists:support_ticket_message_audios,id'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'support_ticket_message_audios_ids.required'   => trans('validations/api/general/support/ticket/message/audio/destroyMany.support_ticket_message_audios_ids.required'),
            'support_ticket_message_audios_ids.array'      => trans('validations/api/general/support/ticket/message/audio/destroyMany.support_ticket_message_audios_ids.array'),
            'support_ticket_message_audios_ids.*.required' => trans('validations/api/general/support/ticket/message/audio/destroyMany.support_ticket_message_audios_ids.*.required'),
            'support_ticket_message_audios_ids.*.integer'  => trans('validations/api/general/support/ticket/message/audio/destroyMany.support_ticket_message_audios_ids.*.integer'),
            'support_ticket_message_audios_ids.*.exists'   => trans('validations/api/general/support/ticket/message/audio/destroyMany.support_ticket_message_audios_ids.*.exists')
        ];
    }
}
