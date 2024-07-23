<?php

namespace App\Http\Requests\Api\General\Payment\Method\Image;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreRequest
 *
 * @package App\Http\Requests\Api\General\Payment\Method\Image
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
            'content.required'   => trans('validations/api/general/payment/method/image/store.content.required'),
            'content.string'     => trans('validations/api/general/payment/method/image/store.content.string'),
            'extension.required' => trans('validations/api/general/payment/method/image/store.extension.required'),
            'extension.string'   => trans('validations/api/general/payment/method/image/store.extension.string'),
            'mime.required'      => trans('validations/api/general/payment/method/image/store.mime.required'),
            'mime.string'        => trans('validations/api/general/payment/method/image/store.mime.string')
        ];
    }
}
