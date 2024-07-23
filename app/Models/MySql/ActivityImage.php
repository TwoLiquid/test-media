<?php

namespace App\Models\MySql;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Eloquent;

/**
 * App\Models\MySql\ActivityImage
 *
 * @property int $id
 * @property int $activity_id
 * @property string $type
 * @property string $url
 * @property string $mime
 * @method static Builder|ActivityImage newModelQuery()
 * @method static Builder|ActivityImage newQuery()
 * @method static Builder|ActivityImage query()
 * @method static Builder|ActivityImage whereActivityId($value)
 * @method static Builder|ActivityImage whereId($value)
 * @method static Builder|ActivityImage whereMime($value)
 * @method static Builder|ActivityImage whereType($value)
 * @method static Builder|ActivityImage whereUrl($value)
 * @mixin Eloquent
 */
class ActivityImage extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'activity_images';

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
        'activity_id', 'type', 'url', 'mime'
    ];
}
