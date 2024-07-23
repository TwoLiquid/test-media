<?php

namespace App\Models\MySql;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Eloquent;

/**
 * App\Models\MySql\PaymentMethodImage
 *
 * @property int $id
 * @property int $method_id
 * @property string $url
 * @property string $mime
 * @method static Builder|PaymentMethodImage newModelQuery()
 * @method static Builder|PaymentMethodImage newQuery()
 * @method static Builder|PaymentMethodImage query()
 * @method static Builder|PaymentMethodImage whereId($value)
 * @method static Builder|PaymentMethodImage whereMethodId($value)
 * @method static Builder|PaymentMethodImage whereMime($value)
 * @method static Builder|PaymentMethodImage whereUrl($value)
 * @mixin Eloquent
 */
class PaymentMethodImage extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'payment_method_images';

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
        'method_id', 'url', 'mime'
    ];
}
