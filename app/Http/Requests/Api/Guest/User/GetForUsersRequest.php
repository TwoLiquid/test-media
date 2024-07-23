<?php

namespace App\Http\Requests\Api\Guest\User;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class GetForUsersRequest
 *
 * @package App\Http\Requests\Api\Guest\User
 */
class GetForUsersRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'avatars_ids'         => 'array|nullable',
            'avatars_ids.*'       => 'required|integer',
            'voice_samples_ids'   => 'array|nullable',
            'voice_samples_ids.*' => 'required|integer',
            'backgrounds_ids'     => 'array|nullable',
            'backgrounds_ids.*'   => 'required|integer',
            'images_ids'          => 'array|nullable',
            'images_ids.*'        => 'required|integer',
            'videos_ids'          => 'array|nullable',
            'videos_ids.*'        => 'required|integer',
            'vybes_images_ids'    => 'array|nullable',
            'vybes_images_ids.*'  => 'required|integer',
            'vybes_videos_ids'    => 'array|nullable',
            'vybes_videos_ids.*'  => 'required|integer',
            'activities_ids'      => 'array|nullable',
            'activities_ids.*'    => 'required|integer',
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'avatars_ids.array'           => trans('validations/api/guest/user/getForUsers.avatars_ids.array'),
            'avatars_ids.*.integer'       => trans('validations/api/guest/user/getForUsers.avatars_ids.*.integer'),
            'voice_samples_ids.array'     => trans('validations/api/guest/user/getForUsers.voice_samples_ids.array'),
            'voice_samples_ids.*.integer' => trans('validations/api/guest/user/getForUsers.voice_samples_ids.*.integer'),
            'backgrounds_ids.array'       => trans('validations/api/guest/user/getForUsers.backgrounds_ids.array'),
            'backgrounds_ids.*.integer'   => trans('validations/api/guest/user/getForUsers.backgrounds_ids.*.integer'),
            'images_ids.array'            => trans('validations/api/guest/user/getForUsers.images_ids.array'),
            'images_ids.*.integer'        => trans('validations/api/guest/user/getForUsers.images_ids.*.integer'),
            'videos_ids.array'            => trans('validations/api/guest/user/getForUsers.videos_ids.array'),
            'videos_ids.*.integer'        => trans('validations/api/guest/user/getForUsers.videos_ids.*.integer'),
            'vybes_images_ids.array'      => trans('validations/api/guest/user/getForUsers.vybes_images_ids.array'),
            'vybes_images_ids.*.integer'  => trans('validations/api/guest/user/getForUsers.vybes_images_ids.*.integer'),
            'vybes_videos_ids.array'      => trans('validations/api/guest/user/getForUsers.vybes_videos_ids.array'),
            'vybes_videos_ids.*.integer'  => trans('validations/api/guest/user/getForUsers.vybes_videos_ids.*.integer'),
            'activities_ids.array'        => trans('validations/api/guest/user/getForUsers.activities_ids.array'),
            'activities_ids.*.integer'    => trans('validations/api/guest/user/getForUsers.activities_ids.*.integer')
        ];
    }
}
