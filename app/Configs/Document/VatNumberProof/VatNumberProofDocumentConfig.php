<?php

namespace App\Configs\Document\VatNumberProof;

use App\Configs\Document\BaseDocumentConfig;

/**
 * Class VatNumberProofDocumentConfig
 *
 * @package App\Configs\Document\VatNumberProof
 */
abstract class VatNumberProofDocumentConfig extends BaseDocumentConfig
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
