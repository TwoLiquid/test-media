<?php

namespace App\Configs\Document\WithdrawalReceiptProof;

use App\Configs\Document\BaseDocumentConfig;

/**
 * Class WithdrawalReceiptProofDocumentConfig
 *
 * @package App\Configs\Document\WithdrawalReceiptProof
 */
abstract class WithdrawalReceiptProofDocumentConfig extends BaseDocumentConfig
{
    /**
     * List of allowed mimes
     *
     * @var array
     */
    protected const ALLOWED_MIMES = [];

    /**
     * Minimum file size
     *
     * @var int
     */
    protected const MINIMUM_SIZE = 0;

    /**
     * Maximum file size
     *
     * @var int
     */
    protected const MAXIMUM_SIZE = 20000;
}
