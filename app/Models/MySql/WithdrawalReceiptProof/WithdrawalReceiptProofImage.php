<?php

namespace App\Models\MySql\WithdrawalReceiptProof;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Eloquent;

/**
 * App\Models\MySql\WithdrawalReceiptProof\WithdrawalReceiptProofImage
 *
 * @property int $id
 * @property int $receipt_id
 * @property string $url
 * @property string $mime
 * @method static Builder|WithdrawalReceiptProofImage newModelQuery()
 * @method static Builder|WithdrawalReceiptProofImage newQuery()
 * @method static Builder|WithdrawalReceiptProofImage query()
 * @method static Builder|WithdrawalReceiptProofImage whereId($value)
 * @method static Builder|WithdrawalReceiptProofImage whereMime($value)
 * @method static Builder|WithdrawalReceiptProofImage whereReceiptId($value)
 * @method static Builder|WithdrawalReceiptProofImage whereUrl($value)
 * @mixin Eloquent
 */
class WithdrawalReceiptProofImage extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'withdrawal_receipt_proof_images';

    /**
     * Provide default timestamps usage
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'receipt_id', 'url', 'mime'
    ];
}
