<?php

namespace App\Http\Requests\Api\Guest\User\Avatar;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class GetForUsersRequest
 *
 * @package App\Http\Requests\Api\Guest\User\Avatar
 */
class GetForUsersRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'auth_ids'   => 'required|array',
            'auth_ids.*' => 'required|integer'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'auth_ids.required'   => trans('validations/api/guest/user/avatar/getForUsers.auth_ids.required'),
            'auth_ids.array'      => trans('validations/api/guest/user/avatar/getForUsers.auth_ids.array'),
            'auth_ids.*.required' => trans('validations/api/guest/user/avatar/getForUsers.auth_ids.*.required'),
            'auth_ids.*.integer'  => trans('validations/api/guest/user/avatar/getForUsers.auth_ids.*.integer')
        ];
    }
}
