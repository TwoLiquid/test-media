<?php

namespace App\Http\Requests\Api\General\Vybe\Video;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreManyRequest
 *
 * @package App\Http\Requests\Api\General\Vybe\Video
 */
class StoreManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'vybe_videos'             => 'required|array',
            'vybe_videos.*.content'   => 'required|string',
            'vybe_videos.*.mime'      => 'required|string',
            'vybe_videos.*.extension' => 'required|string',
            'vybe_videos.*.main'      => 'boolean|nullable',
            'vybe_videos.*.declined'  => 'boolean|nullable'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'vybe_videos.required'             => trans('validations/api/general/vybe/video/storeMany.vybe_videos.required'),
            'vybe_videos.array'                => trans('validations/api/general/vybe/video/storeMany.vybe_videos.array'),
            'vybe_videos.*.content.required'   => trans('validations/api/general/vybe/video/storeMany.vybe_videos.*.content.required'),
            'vybe_videos.*.content.string'     => trans('validations/api/general/vybe/video/storeMany.vybe_videos.*.content.string'),
            'vybe_videos.*.mime.required'      => trans('validations/api/general/vybe/video/storeMany.vybe_videos.*.mime.required'),
            'vybe_videos.*.mime.string'        => trans('validations/api/general/vybe/video/storeMany.vybe_videos.*.mime.string'),
            'vybe_videos.*.extension.required' => trans('validations/api/general/vybe/video/storeMany.vybe_videos.*.extension.required'),
            'vybe_videos.*.extension.string'   => trans('validations/api/general/vybe/video/storeMany.vybe_videos.*.extension.string'),
            'vybe_videos.*.main.boolean'       => trans('validations/api/general/vybe/video/storeMany.vybe_videos.*.main.boolean'),
            'vybe_videos.*.declined.boolean'   => trans('validations/api/general/vybe/video/storeMany.vybe_videos.*.declined.boolean'),
        ];
    }
}
