<?php

namespace App\Http\Requests\Api\General\VatNumber\Proof\Image;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreManyRequest
 *
 * @package App\Http\Requests\Api\General\VatNumber\Proof\Image
 */
class StoreManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'vat_number_proof_images'             => 'required|array',
            'vat_number_proof_images.*.content'   => 'required|string',
            'vat_number_proof_images.*.extension' => 'required|string',
            'vat_number_proof_images.*.mime'      => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'vat_number_proof_images.required'             => trans('validations/api/general/vatNumber/proof/image/storeMany.vat_number_proof_images.required'),
            'vat_number_proof_images.array'                => trans('validations/api/general/vatNumber/proof/image/storeMany.vat_number_proof_images.array'),
            'vat_number_proof_images.*.content.required'   => trans('validations/api/general/vatNumber/proof/image/storeMany.vat_number_proof_images.*.content.required'),
            'vat_number_proof_images.*.content.string'     => trans('validations/api/general/vatNumber/proof/image/storeMany.vat_number_proof_images.*.content.string'),
            'vat_number_proof_images.*.extension.required' => trans('validations/api/general/vatNumber/proof/image/storeMany.vat_number_proof_images.*.extension.required'),
            'vat_number_proof_images.*.extension.string'   => trans('validations/api/general/vatNumber/proof/image/storeMany.vat_number_proof_images.*.extension.string'),
            'vat_number_proof_images.*.mime.required'      => trans('validations/api/general/vatNumber/proof/image/storeMany.vat_number_proof_images.*.mime.required'),
            'vat_number_proof_images.*.mime.string'        => trans('validations/api/general/vatNumber/proof/image/storeMany.vat_number_proof_images.*.mime.string')
        ];
    }
}
