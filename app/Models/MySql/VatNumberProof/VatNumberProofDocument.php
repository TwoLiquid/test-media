<?php

namespace App\Models\MySql\VatNumberProof;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Eloquent;

/**
 * App\Models\MySql\VatNumberProof\VatNumberProofDocument
 *
 * @property int $id
 * @property string|null $vat_number_proof_id
 * @property string $url
 * @property string $mime
 * @property Carbon $created_at
 * @method static Builder|VatNumberProofDocument newModelQuery()
 * @method static Builder|VatNumberProofDocument newQuery()
 * @method static Builder|VatNumberProofDocument query()
 * @method static Builder|VatNumberProofDocument whereCreatedAt($value)
 * @method static Builder|VatNumberProofDocument whereId($value)
 * @method static Builder|VatNumberProofDocument whereMime($value)
 * @method static Builder|VatNumberProofDocument whereUrl($value)
 * @method static Builder|VatNumberProofDocument whereVatNumberProofId($value)
 * @mixin Eloquent
 */
class VatNumberProofDocument extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'vat_number_proof_documents';

    /**
     * Provide default timestamps usage
     *
     * @var bool
     */
    public $timestamps = [
        'created_at'
    ];

    /**
     * Excluding updated at
     */
    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vat_number_proof_id', 'url', 'mime'
    ];
}
