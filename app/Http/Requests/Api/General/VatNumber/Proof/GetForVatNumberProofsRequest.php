<?php

namespace App\Http\Requests\Api\General\VatNumber\Proof;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class GetForVatNumberProofsRequest
 *
 * @package App\Http\Requests\Api\General\VatNumber\Proof
 */
class GetForVatNumberProofsRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'vat_number_proofs_ids'   => 'required|array',
            'vat_number_proofs_ids.*' => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'vat_number_proofs_ids.required'   => trans('validations/api/general/vatNumber/proof/getForVatNumberProofs.vat_number_proofs_ids.required'),
            'vat_number_proofs_ids.array'      => trans('validations/api/general/vatNumber/proof/getForVatNumberProofs.vat_number_proofs_ids.array'),
            'vat_number_proofs_ids.*.required' => trans('validations/api/general/vatNumber/proof/getForVatNumberProofs.vat_number_proofs_ids.*.required'),
            'vat_number_proofs_ids.*.string'   => trans('validations/api/general/vatNumber/proof/getForVatNumberProofs.vat_number_proofs_ids.*.string')
        ];
    }
}
