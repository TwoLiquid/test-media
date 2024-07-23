<?php

namespace App\Http\Requests\Api\General\Support\Ticket\Message\Video;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class DestroyManyRequest
 *
 * @package App\Http\Requests\Api\General\Support\Ticket\Message\Video
 */
class DestroyManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'support_ticket_message_videos_ids'   => 'required|array',
            'support_ticket_message_videos_ids.*' => 'required|integer|exists:support_ticket_message_videos,id'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'support_ticket_message_videos_ids.required'   => trans('validations/api/general/support/ticket/message/video/destroyMany.support_ticket_message_videos_ids.required'),
            'support_ticket_message_videos_ids.array'      => trans('validations/api/general/support/ticket/message/video/destroyMany.support_ticket_message_videos_ids.array'),
            'support_ticket_message_videos_ids.*.required' => trans('validations/api/general/support/ticket/message/video/destroyMany.support_ticket_message_videos_ids.*.required'),
            'support_ticket_message_videos_ids.*.integer'  => trans('validations/api/general/support/ticket/message/video/destroyMany.support_ticket_message_videos_ids.*.integer'),
            'support_ticket_message_videos_ids.*.exists'   => trans('validations/api/general/support/ticket/message/video/destroyMany.support_ticket_message_videos_ids.*.exists')
        ];
    }
}
