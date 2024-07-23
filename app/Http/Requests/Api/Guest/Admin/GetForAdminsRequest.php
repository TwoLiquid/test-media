<?php

namespace App\Http\Requests\Api\Guest\Admin;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class GetForAdminsRequest
 *
 * @package App\Http\Requests\Api\Guest\Admin
 */
class GetForAdminsRequest extends BaseRequest
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
            'auth_ids.required'   => trans('validations/api/guest/admin/avatar/getForAdmins.auth_ids.required'),
            'auth_ids.array'      => trans('validations/api/guest/admin/avatar/getForAdmins.auth_ids.array'),
            'auth_ids.*.required' => trans('validations/api/guest/admin/avatar/getForAdmins.auth_ids.*.required'),
            'auth_ids.*.integer'  => trans('validations/api/guest/admin/avatar/getForAdmins.auth_ids.*.integer')
        ];
    }
}
