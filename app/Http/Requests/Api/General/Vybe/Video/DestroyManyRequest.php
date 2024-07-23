<?php

namespace App\Http\Requests\Api\General\Vybe\Video;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class DestroyManyRequest
 *
 * @package App\Http\Requests\Api\General\Vybe\Video
 */
class DestroyManyRequest extends BaseRequest
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
            'vybe_videos_ids.required'   => trans('validations/api/general/vybe/video/destroyMany.vybe_videos_ids.required'),
            'vybe_videos_ids.array'      => trans('validations/api/general/vybe/video/destroyMany.vybe_videos_ids.array'),
            'vybe_videos_ids.*.required' => trans('validations/api/general/vybe/video/destroyMany.vybe_videos_ids.*.required'),
            'vybe_videos_ids.*.integer'  => trans('validations/api/general/vybe/video/destroyMany.vybe_videos_ids.*.integer'),
            'vybe_videos_ids.*.exists'   => trans('validations/api/general/vybe/video/destroyMany.vybe_videos_ids.*.exists')
        ];
    }
}
