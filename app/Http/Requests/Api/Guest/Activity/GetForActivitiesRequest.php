<?php

namespace App\Http\Requests\Api\Guest\Activity;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class GetForActivitiesRequest
 *
 * @package App\Http\Requests\Api\Guest\Activity
 */
class GetForActivitiesRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'activities_ids'   => 'array|nullable',
            'activities_ids.*' => 'required|integer'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'activities_ids.array'      => trans('validations/api/guest/activity/image/getForActivities.activities_ids.array'),
            'activities_ids.*.required' => trans('validations/api/guest/activity/image/getForActivities.activities_ids.*.required'),
            'activities_ids.*.integer'  => trans('validations/api/guest/activity/image/getForActivities.activities_ids.*.integer')
        ];
    }
}
