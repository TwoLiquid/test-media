<?php

namespace App\Http\Requests\Api\General\Withdrawal\Receipt\Proof;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class GetForWithdrawalReceiptProofsRequest
 *
 * @package App\Http\Requests\Api\General\Withdrawal\Receipt\Proof
 */
class GetForWithdrawalReceiptProofsRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'withdrawal_receipts_ids'   => 'required|array',
            'withdrawal_receipts_ids.*' => 'required|integer'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'withdrawal_receipts_ids.required'   => trans('validations/api/general/withdrawal/receipt/proof/getForWithdrawalReceiptProofs.withdrawal_receipts_ids.required'),
            'withdrawal_receipts_ids.array'      => trans('validations/api/general/withdrawal/receipt/proof/getForWithdrawalReceiptProofs.withdrawal_receipts_ids.array'),
            'withdrawal_receipts_ids.*.required' => trans('validations/api/general/withdrawal/receipt/proof/getForWithdrawalReceiptProofs.withdrawal_receipts_ids.*.required'),
            'withdrawal_receipts_ids.*.integer'  => trans('validations/api/general/withdrawal/receipt/proof/getForWithdrawalReceiptProofs.withdrawal_receipts_ids.*.integer')
        ];
    }
}
