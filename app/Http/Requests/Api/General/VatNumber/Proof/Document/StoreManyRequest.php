<?php

namespace App\Http\Requests\Api\General\VatNumber\Proof\Document;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreManyRequest
 *
 * @package App\Http\Requests\Api\General\VatNumber\Proof\Document
 */
class StoreManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'vat_number_proof_documents'             => 'required|array',
            'vat_number_proof_documents.*.content'   => 'required|string',
            'vat_number_proof_documents.*.extension' => 'required|string',
            'vat_number_proof_documents.*.mime'      => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'vat_number_proof_documents.required'             => trans('validations/api/general/vatNumber/proof/document/storeMany.vat_number_proof_documents.required'),
            'vat_number_proof_documents.array'                => trans('validations/api/general/vatNumber/proof/document/storeMany.vat_number_proof_documents.array'),
            'vat_number_proof_documents.*.content.required'   => trans('validations/api/general/vatNumber/proof/document/storeMany.vat_number_proof_documents.*.content.required'),
            'vat_number_proof_documents.*.content.string'     => trans('validations/api/general/vatNumber/proof/document/storeMany.vat_number_proof_documents.*.content.string'),
            'vat_number_proof_documents.*.extension.required' => trans('validations/api/general/vatNumber/proof/document/storeMany.vat_number_proof_documents.*.extension.required'),
            'vat_number_proof_documents.*.extension.string'   => trans('validations/api/general/vatNumber/proof/document/storeMany.vat_number_proof_documents.*.extension.string'),
            'vat_number_proof_documents.*.mime.required'      => trans('validations/api/general/vatNumber/proof/document/storeMany.vat_number_proof_documents.*.mime.required'),
            'vat_number_proof_documents.*.mime.string'        => trans('validations/api/general/vatNumber/proof/document/storeMany.vat_number_proof_documents.*.mime.string')
        ];
    }
}
