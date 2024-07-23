<?php

namespace App\Models\MySql\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Eloquent;

/**
 * App\Models\MySql\User\UserAvatar
 *
 * @property int $id
 * @property int $auth_id
 * @property string|null $request_id
 * @property string $url
 * @property string $mime
 * @property bool|null $declined
 * @method static Builder|UserAvatar newModelQuery()
 * @method static Builder|UserAvatar newQuery()
 * @method static Builder|UserAvatar query()
 * @method static Builder|UserAvatar whereAuthId($value)
 * @method static Builder|UserAvatar whereDeclined($value)
 * @method static Builder|UserAvatar whereId($value)
 * @method static Builder|UserAvatar whereMime($value)
 * @method static Builder|UserAvatar whereRequestId($value)
 * @method static Builder|UserAvatar whereUrl($value)
 * @mixin Eloquent
 */
class UserAvatar extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'user_avatars';

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
        'auth_id', 'request_id', 'url', 'mime', 'declined'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'declined' => 'boolean'
    ];
}
