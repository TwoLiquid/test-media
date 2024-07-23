<?php

namespace App\Http\Requests\Api\General\Review\Message;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class GetForReviewMessagesRequest
 *
 * @package App\Http\Requests\Api\General\Review\Message
 */
class GetForReviewMessagesRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'review_messages_ids'   => 'required|array',
            'review_messages_ids.*' => 'required|string',
            'auth_ids'              => 'required|array',
            'auth_ids.*'            => 'required|integer',
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'review_messages_ids.required'   => trans('validations/api/general/review/message/getForReviewMessages.review_messages_ids.required'),
            'review_messages_ids.array'      => trans('validations/api/general/review/message/getForReviewMessages.review_messages_ids.array'),
            'review_messages_ids.*.required' => trans('validations/api/general/review/message/getForReviewMessages.review_messages_ids.*.required'),
            'review_messages_ids.*.string'   => trans('validations/api/general/review/message/getForReviewMessages.review_messages_ids.*.string'),
            'auth_ids.required'              => trans('validations/api/general/review/message/getForReviewMessages.auth_ids.required'),
            'auth_ids.array'                 => trans('validations/api/general/review/message/getForReviewMessages.auth_ids.array'),
            'auth_ids.*.required'            => trans('validations/api/general/review/message/getForReviewMessages.auth_ids.*.required'),
            'auth_ids.*.integer'             => trans('validations/api/general/review/message/getForReviewMessages.auth_ids.*.integer')
        ];
    }
}
