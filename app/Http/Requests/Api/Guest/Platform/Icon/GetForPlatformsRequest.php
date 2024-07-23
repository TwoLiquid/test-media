<?php

namespace App\Http\Requests\Api\Guest\Platform\Icon;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class GetForPlatformsRequest
 *
 * @package App\Http\Requests\Api\Guest\Platform\Icon
 */
class GetForPlatformsRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'platforms_ids'   => 'required|array',
            'platforms_ids.*' => 'required|integer'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'platforms_ids.required'   => trans('validations/api/guest/platform/icon/getForPlatforms.platforms_ids.required'),
            'platforms_ids.array'      => trans('validations/api/guest/platform/icon/getForPlatforms.platforms_ids.array'),
            'platforms_ids.*.required' => trans('validations/api/guest/platform/icon/getForPlatforms.platforms_ids.*.required'),
            'platforms_ids.*.integer'  => trans('validations/api/guest/platform/icon/getForPlatforms.platforms_ids.*.integer'),
            'platforms_ids.*.exists'   => trans('validations/api/guest/platform/icon/getForPlatforms.platforms_ids.*.exists')
        ];
    }
}
