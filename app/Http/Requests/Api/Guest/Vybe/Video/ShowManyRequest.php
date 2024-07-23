<?php

namespace App\Http\Requests\Api\Guest\Vybe\Video;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class ShowManyRequest
 *
 * @package App\Http\Requests\Api\Guest\Vybe\Video
 */
class ShowManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'vybe_videos_ids'   => 'required|array',
            'vybe_videos_ids.*' => 'required|integer|exists:vybe_videos,id'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'vybe_videos_ids.required'   => trans('validations/api/guest/vybe/video/showMany.vybe_videos_ids.required'),
            'vybe_videos_ids.array'      => trans('validations/api/guest/vybe/video/showMany.vybe_videos_ids.array'),
            'vybe_videos_ids.*.required' => trans('validations/api/guest/vybe/video/showMany.vybe_videos_ids.*.required'),
            'vybe_videos_ids.*.integer'  => trans('validations/api/guest/vybe/video/showMany.vybe_videos_ids.*.integer'),
            'vybe_videos_ids.*.exists'   => trans('validations/api/guest/vybe/video/showMany.vybe_videos_ids.*.exists')
        ];
    }
}
