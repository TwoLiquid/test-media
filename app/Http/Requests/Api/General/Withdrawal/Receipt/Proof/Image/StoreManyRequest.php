<?php

namespace App\Http\Requests\Api\General\Withdrawal\Receipt\Proof\Image;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreManyRequest
 *
 * @package App\Http\Requests\Api\General\Withdrawal\Receipt\Proof\Image
 */
class StoreManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'withdrawal_receipt_proof_images'             => 'required|array',
            'withdrawal_receipt_proof_images.*.content'   => 'required|string',
            'withdrawal_receipt_proof_images.*.mime'      => 'required|string',
            'withdrawal_receipt_proof_images.*.extension' => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'withdrawal_receipt_proof_images.required'             => trans('validations/api/general/withdrawal/receipt/proof/image/storeMany.withdrawal_receipt_proof_images.required'),
            'withdrawal_receipt_proof_images.array'                => trans('validations/api/general/withdrawal/receipt/proof/image/storeMany.withdrawal_receipt_proof_images.array'),
            'withdrawal_receipt_proof_images.*.content.required'   => trans('validations/api/general/withdrawal/receipt/proof/image/storeMany.withdrawal_receipt_proof_images.*.content.required'),
            'withdrawal_receipt_proof_images.*.content.string'     => trans('validations/api/general/withdrawal/receipt/proof/image/storeMany.withdrawal_receipt_proof_images.*.content.string'),
            'withdrawal_receipt_proof_images.*.mime.required'      => trans('validations/api/general/withdrawal/receipt/proof/image/storeMany.withdrawal_receipt_proof_images.*.mime.required'),
            'withdrawal_receipt_proof_images.*.mime.string'        => trans('validations/api/general/withdrawal/receipt/proof/image/storeMany.withdrawal_receipt_proof_images.*.mime.string'),
            'withdrawal_receipt_proof_images.*.extension.required' => trans('validations/api/general/withdrawal/receipt/proof/image/storeMany.withdrawal_receipt_proof_images.*.extension.required'),
            'withdrawal_receipt_proof_images.*.extension.string'   => trans('validations/api/general/withdrawal/receipt/proof/image/storeMany.withdrawal_receipt_proof_images.*.extension.string')
        ];
    }
}
