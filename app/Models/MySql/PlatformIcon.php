<?php

namespace App\Models\MySql;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Eloquent;

/**
 * App\Models\MySql\PlatformIcon
 *
 * @property int $id
 * @property int $platform_id
 * @property string $url
 * @property string $mime
 * @method static Builder|PlatformIcon newModelQuery()
 * @method static Builder|PlatformIcon newQuery()
 * @method static Builder|PlatformIcon query()
 * @method static Builder|PlatformIcon whereId($value)
 * @method static Builder|PlatformIcon whereMime($value)
 * @method static Builder|PlatformIcon wherePlatformId($value)
 * @method static Builder|PlatformIcon whereUrl($value)
 * @mixin Eloquent
 */
class PlatformIcon extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'platform_icons';

    /**
     * Provide default timestamps usage
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'platform_id', 'url', 'mime'
    ];
}
