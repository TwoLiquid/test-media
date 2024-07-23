<?php

namespace App\Http\Requests\Api\General\User\Video;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreManyRequest
 *
 * @package App\Http\Requests\Api\General\User\Video
 */
class StoreManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'user_videos'              => 'required|array',
            'user_videos.*.request_id' => 'string|nullable',
            'user_videos.*.content'    => 'required|string',
            'user_videos.*.mime'       => 'required|string',
            'user_videos.*.extension'  => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'user_videos.required'             => trans('validations/api/general/user/video/storeMany.user_videos.required'),
            'user_videos.array'                => trans('validations/api/general/user/video/storeMany.user_videos.array'),
            'user_videos.*.request_id.string'  => trans('validations/api/general/user/video/storeMany.user_videos.*.request_id.string'),
            'user_videos.*.content.required'   => trans('validations/api/general/user/video/storeMany.user_videos.*.content.required'),
            'user_videos.*.content.string'     => trans('validations/api/general/user/video/storeMany.user_videos.*.content.string'),
            'user_videos.*.mime.required'      => trans('validations/api/general/user/video/storeMany.user_videos.*.mime.required'),
            'user_videos.*.mime.string'        => trans('validations/api/general/user/video/storeMany.user_videos.*.mime.string'),
            'user_videos.*.extension.required' => trans('validations/api/general/user/video/storeMany.user_videos.*.extension.required'),
            'user_videos.*.extension.string'   => trans('validations/api/general/user/video/storeMany.user_videos.*.extension.string')
        ];
    }
}
