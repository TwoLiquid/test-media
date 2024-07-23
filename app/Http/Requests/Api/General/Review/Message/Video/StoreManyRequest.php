<?php

namespace App\Http\Requests\Api\General\Review\Message\Video;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreManyRequest
 *
 * @package App\Http\Requests\Api\General\Review\Message\Video
 */
class StoreManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'review_message_videos'             => 'required|array',
            'review_message_videos.*.content'   => 'required|string',
            'review_message_videos.*.extension' => 'required|string',
            'review_message_videos.*.mime'      => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'review_message_videos.required'             => trans('validations/api/general/review/message/video/storeMany.review_message_videos.required'),
            'review_message_videos.array'                => trans('validations/api/general/review/message/video/storeMany.review_message_videos.array'),
            'review_message_videos.*.content.required'   => trans('validations/api/general/review/message/video/storeMany.review_message_videos.*.content.required'),
            'review_message_videos.*.content.string'     => trans('validations/api/general/review/message/video/storeMany.review_message_videos.*.content.string'),
            'review_message_videos.*.extension.required' => trans('validations/api/general/review/message/video/storeMany.review_message_videos.*.extension.required'),
            'review_message_videos.*.extension.string'   => trans('validations/api/general/review/message/video/storeMany.review_message_videos.*.extension.string'),
            'review_message_videos.*.mime.required'      => trans('validations/api/general/review/message/video/storeMany.review_message_videos.*.mime.required'),
            'review_message_videos.*.mime.string'        => trans('validations/api/general/review/message/video/storeMany.review_message_videos.*.mime.string')
        ];
    }
}
