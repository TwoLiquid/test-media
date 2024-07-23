<?php

namespace App\Http\Requests\Api\General\User\IdVerification\Image;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreRequest
 *
 * @package App\Http\Requests\Api\General\User\IdVerification\Image
 */
class StoreRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'request_id' => 'string|nullable',
            'content'    => 'required|string',
            'mime'       => 'required|string',
            'extension'  => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'request_id.string'  => trans('validations/api/general/user/idVerification/image/store.request_id.string'),
            'content.required'   => trans('validations/api/general/user/idVerification/image/store.content.required'),
            'content.string'     => trans('validations/api/general/user/idVerification/image/store.content.string'),
            'mime.required'      => trans('validations/api/general/user/idVerification/image/store.mime.required'),
            'mime.string'        => trans('validations/api/general/user/idVerification/image/store.mime.string'),
            'extension.required' => trans('validations/api/general/user/idVerification/image/store.extension.required'),
            'extension.string'   => trans('validations/api/general/user/idVerification/image/store.extension.string')
        ];
    }
}
