<?php

namespace App\Http\Requests\Api\General\Device\Icon;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreRequest
 *
 * @package App\Http\Requests\Api\General\Device\Icon
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
            'extension' => 'required|string',
            'mime'      => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'content.required'   => trans('validations/api/general/device/icon/store.content.required'),
            'content.string'     => trans('validations/api/general/device/icon/store.content.string'),
            'extension.required' => trans('validations/api/general/device/icon/store.extension.required'),
            'extension.string'   => trans('validations/api/general/device/icon/store.extension.string'),
            'mime.required'      => trans('validations/api/general/device/icon/store.mime.required'),
            'mime.string'        => trans('validations/api/general/device/icon/store.mime.string')
        ];
    }
}
