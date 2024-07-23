<?php

namespace App\Http\Requests\Api\Guest\User;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class GetForUserRequest
 *
 * @package App\Http\Requests\Api\Guest\User
 */
class GetForUserRequest extends BaseRequest
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
            'vybe_images_ids'     => 'array|nullable',
            'vybe_images_ids.*'   => 'required|integer',
            'vybe_videos_ids'     => 'array|nullable',
            'vybe_videos_ids.*'   => 'required|integer',
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
            'avatars_ids.array'           => trans('validations/api/guest/user/getForUser.avatars_ids.array'),
            'avatars_ids.*.integer'       => trans('validations/api/guest/user/getForUser.avatars_ids.*.integer'),
            'voice_samples_ids.array'     => trans('validations/api/guest/user/getForUser.voice_samples_ids.array'),
            'voice_samples_ids.*.integer' => trans('validations/api/guest/user/getForUser.voice_samples_ids.*.integer'),
            'backgrounds_ids.array'       => trans('validations/api/guest/user/getForUser.backgrounds_ids.array'),
            'backgrounds_ids.*.integer'   => trans('validations/api/guest/user/getForUser.backgrounds_ids.*.integer'),
            'images_ids.array'            => trans('validations/api/guest/user/getForUser.images_ids.array'),
            'images_ids.*.integer'        => trans('validations/api/guest/user/getForUser.images_ids.*.integer'),
            'videos_ids.array'            => trans('validations/api/guest/user/getForUser.videos_ids.array'),
            'videos_ids.*.integer'        => trans('validations/api/guest/user/getForUser.videos_ids.*.integer'),
            'vybe_images_ids.array'       => trans('validations/api/guest/user/getForUser.vybe_images_ids.array'),
            'vybe_images_ids.*.integer'   => trans('validations/api/guest/user/getForUser.vybe_images_ids.*.integer'),
            'vybe_videos_ids.array'       => trans('validations/api/guest/user/getForUser.vybe_videos_ids.array'),
            'vybe_videos_ids.*.integer'   => trans('validations/api/guest/user/getForUser.vybe_videos_ids.*.integer'),
            'activities_ids.array'        => trans('validations/api/guest/user/getForUser.activities_ids.array'),
            'activities_ids.*.integer'    => trans('validations/api/guest/user/getForUser.activities_ids.*.integer')
        ];
    }
}
