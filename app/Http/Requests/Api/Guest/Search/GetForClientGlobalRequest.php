<?php

namespace App\Http\Requests\Api\Guest\Search;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class GetForClientGlobalRequest
 *
 * @package App\Http\Requests\Api\Guest\Search
 */
class GetForClientGlobalRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'auth_ids'          => 'array|nullable',
            'auth_ids.*'        => 'required|integer',
            'vybe_images_ids'   => 'array|nullable',
            'vybe_images_ids.*' => 'required|integer',
            'vybe_videos_ids'   => 'array|nullable',
            'vybe_videos_ids.*' => 'required|integer',
            'activities_ids'    => 'array|nullable',
            'activities_ids.*'  => 'required|integer'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'auth_ids.array'             => trans('validations/api/guest/search/getForClientGlobal.auth_ids.array'),
            'auth_ids.*.required'        => trans('validations/api/guest/search/getForClientGlobal.auth_ids.*.required'),
            'auth_ids.*.integer'         => trans('validations/api/guest/search/getForClientGlobal.auth_ids.*.integer'),
            'vybe_images_ids.array'      => trans('validations/api/guest/search/getForClientGlobal.vybe_images_ids.array'),
            'vybe_images_ids.*.required' => trans('validations/api/guest/search/getForClientGlobal.vybe_images_ids.*.required'),
            'vybe_images_ids.*.integer'  => trans('validations/api/guest/search/getForClientGlobal.vybe_images_ids.*.integer'),
            'vybe_videos_ids.array'      => trans('validations/api/guest/search/getForClientGlobal.vybe_videos_ids.array'),
            'vybe_videos_ids.*.required' => trans('validations/api/guest/search/getForClientGlobal.vybe_videos_ids.*.required'),
            'vybe_videos_ids.*.integer'  => trans('validations/api/guest/search/getForClientGlobal.vybe_videos_ids.*.integer'),
            'activities_ids.array'       => trans('validations/api/guest/search/getForClientGlobal.activities_ids.array'),
            'activities_ids.*.required'  => trans('validations/api/guest/search/getForClientGlobal.activities_ids.*.required'),
            'activities_ids.*.integer'   => trans('validations/api/guest/search/getForClientGlobal.activities_ids.*.integer')
        ];
    }
}
