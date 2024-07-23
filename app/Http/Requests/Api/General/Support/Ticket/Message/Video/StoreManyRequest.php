<?php

namespace App\Http\Requests\Api\General\Support\Ticket\Message\Video;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreManyRequest
 *
 * @package App\Http\Requests\Api\General\Support\Ticket\Message\Video
 */
class StoreManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'support_ticket_message_videos'             => 'required|array',
            'support_ticket_message_videos.*.content'   => 'required|string',
            'support_ticket_message_videos.*.extension' => 'required|string',
            'support_ticket_message_videos.*.mime'      => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'support_ticket_message_videos.required'             => trans('validations/api/general/support/ticket/message/video/storeMany.support_ticket_message_videos.required'),
            'support_ticket_message_videos.array'                => trans('validations/api/general/support/ticket/message/video/storeMany.support_ticket_message_videos.array'),
            'support_ticket_message_videos.*.content.required'   => trans('validations/api/general/support/ticket/message/video/storeMany.support_ticket_message_videos.*.content.required'),
            'support_ticket_message_videos.*.content.string'     => trans('validations/api/general/support/ticket/message/video/storeMany.support_ticket_message_videos.*.content.string'),
            'support_ticket_message_videos.*.extension.required' => trans('validations/api/general/support/ticket/message/video/storeMany.support_ticket_message_videos.*.extension.required'),
            'support_ticket_message_videos.*.extension.string'   => trans('validations/api/general/support/ticket/message/video/storeMany.support_ticket_message_videos.*.extension.string'),
            'support_ticket_message_videos.*.mime.required'      => trans('validations/api/general/support/ticket/message/video/storeMany.support_ticket_message_videos.*.mime.required'),
            'support_ticket_message_videos.*.mime.string'        => trans('validations/api/general/support/ticket/message/video/storeMany.support_ticket_message_videos.*.mime.string')
        ];
    }
}
