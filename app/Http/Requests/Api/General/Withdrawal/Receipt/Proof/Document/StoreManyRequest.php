<?php

namespace App\Http\Requests\Api\General\Withdrawal\Receipt\Proof\Document;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreManyRequest
 *
 * @package App\Http\Requests\Api\General\Withdrawal\Receipt\Proof\Document
 */
class StoreManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'withdrawal_receipt_proof_documents'             => 'required|array',
            'withdrawal_receipt_proof_documents.*.content'   => 'required|string',
            'withdrawal_receipt_proof_documents.*.mime'      => 'required|string',
            'withdrawal_receipt_proof_documents.*.extension' => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'withdrawal_receipt_proof_documents.required'             => trans('validations/api/general/withdrawal/receipt/proof/document/storeMany.withdrawal_receipt_proof_documents.required'),
            'withdrawal_receipt_proof_documents.array'                => trans('validations/api/general/withdrawal/receipt/proof/document/storeMany.withdrawal_receipt_proof_documents.array'),
            'withdrawal_receipt_proof_documents.*.content.required'   => trans('validations/api/general/withdrawal/receipt/proof/document/storeMany.withdrawal_receipt_proof_documents.*.content.required'),
            'withdrawal_receipt_proof_documents.*.content.string'     => trans('validations/api/general/withdrawal/receipt/proof/document/storeMany.withdrawal_receipt_proof_documents.*.content.string'),
            'withdrawal_receipt_proof_documents.*.mime.required'      => trans('validations/api/general/withdrawal/receipt/proof/document/storeMany.withdrawal_receipt_proof_documents.*.mime.required'),
            'withdrawal_receipt_proof_documents.*.mime.string'        => trans('validations/api/general/withdrawal/receipt/proof/document/storeMany.withdrawal_receipt_proof_documents.*.mime.string'),
            'withdrawal_receipt_proof_documents.*.extension.required' => trans('validations/api/general/withdrawal/receipt/proof/document/storeMany.withdrawal_receipt_proof_documents.*.extension.required'),
            'withdrawal_receipt_proof_documents.*.extension.string'   => trans('validations/api/general/withdrawal/receipt/proof/document/storeMany.withdrawal_receipt_proof_documents.*.extension.string')
        ];
    }
}
