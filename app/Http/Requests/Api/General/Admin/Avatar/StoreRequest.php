<?php

namespace App\Http\Requests\Api\General\Admin\Avatar;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreRequest
 *
 * @package App\Http\Requests\Api\General\Admin\Avatar
 */
class StoreRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'content'   => 'required|string',
            'mime'      => 'required|string',
            'extension' => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'content.required'   => trans('validations/api/general/admin/avatar/store.content.required'),
            'content.string'     => trans('validations/api/general/admin/avatar/store.content.string'),
            'mime.required'      => trans('validations/api/general/admin/avatar/store.mime.required'),
            'mime.string'        => trans('validations/api/general/admin/avatar/store.mime.string'),
            'extension.required' => trans('validations/api/general/admin/avatar/store.extension.required'),
            'extension.string'   => trans('validations/api/general/admin/avatar/store.extension.string')
        ];
    }
}
