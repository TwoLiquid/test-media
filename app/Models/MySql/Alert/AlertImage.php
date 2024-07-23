<?php

namespace App\Models\MySql\Alert;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Eloquent;

/**
 * App\Models\MySql\Alert\AlertImage
 *
 * @property int $id
 * @property int|null $alert_id
 * @property string $url
 * @property string $mime
 * @property bool $active
 * @method static Builder|AlertImage newModelQuery()
 * @method static Builder|AlertImage newQuery()
 * @method static Builder|AlertImage query()
 * @method static Builder|AlertImage whereActive($value)
 * @method static Builder|AlertImage whereAlertId($value)
 * @method static Builder|AlertImage whereId($value)
 * @method static Builder|AlertImage whereMime($value)
 * @method static Builder|AlertImage whereUrl($value)
 * @mixin Eloquent
 */
class AlertImage extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'alert_images';

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
        'alert_id', 'url', 'mime', 'active'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean'
    ];
}
