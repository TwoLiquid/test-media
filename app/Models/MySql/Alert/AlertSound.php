<?php

namespace App\Models\MySql\Alert;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Eloquent;

/**
 * App\Models\MySql\Alert\AlertSound
 *
 * @property int $id
 * @property int $alert_id
 * @property string $url
 * @property float|null $duration
 * @property string $mime
 * @property bool $active
 * @method static Builder|AlertSound newModelQuery()
 * @method static Builder|AlertSound newQuery()
 * @method static Builder|AlertSound query()
 * @method static Builder|AlertSound whereActive($value)
 * @method static Builder|AlertSound whereAlertId($value)
 * @method static Builder|AlertSound whereDuration($value)
 * @method static Builder|AlertSound whereId($value)
 * @method static Builder|AlertSound whereMime($value)
 * @method static Builder|AlertSound whereUrl($value)
 * @mixin Eloquent
 */
class AlertSound extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'alert_sounds';

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
        'alert_id', 'url', 'duration', 'mime', 'active'
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
