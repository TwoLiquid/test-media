<?php

namespace App\Http\Requests\Api\General\Review\Message\Video;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class DestroyManyRequest
 *
 * @package App\Http\Requests\Api\General\Review\Message\Video
 */
class DestroyManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'review_message_videos_ids'   => 'required|array',
            'review_message_videos_ids.*' => 'required|integer|exists:review_message_videos,id'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'review_message_videos_ids.required'   => trans('validations/api/general/review/message/video/destroyMany.review_message_videos_ids.required'),
            'review_message_videos_ids.array'      => trans('validations/api/general/review/message/video/destroyMany.review_message_videos_ids.array'),
            'review_message_videos_ids.*.required' => trans('validations/api/general/review/message/video/destroyMany.review_message_videos_ids.*.required'),
            'review_message_videos_ids.*.integer'  => trans('validations/api/general/review/message/video/destroyMany.review_message_videos_ids.*.integer'),
            'review_message_videos_ids.*.exists'   => trans('validations/api/general/review/message/video/destroyMany.review_message_videos_ids.*.exists')
        ];
    }
}
