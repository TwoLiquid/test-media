<?php

namespace App\Models\MySql;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Eloquent;

/**
 * App\Models\MySql\AdminAvatar
 *
 * @property int $id
 * @property int $auth_id
 * @property string $url
 * @property string $mime
 * @method static Builder|AdminAvatar newModelQuery()
 * @method static Builder|AdminAvatar newQuery()
 * @method static Builder|AdminAvatar query()
 * @method static Builder|AdminAvatar whereAuthId($value)
 * @method static Builder|AdminAvatar whereId($value)
 * @method static Builder|AdminAvatar whereMime($value)
 * @method static Builder|AdminAvatar whereUrl($value)
 * @mixin Eloquent
 */
class AdminAvatar extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'admin_avatars';

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
        'auth_id', 'url', 'mime'
    ];
}
