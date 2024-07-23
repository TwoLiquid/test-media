<?php

namespace App\Models\MySql\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Eloquent;

/**
 * App\Models\MySql\User\UserImage
 *
 * @property int $id
 * @property int $auth_id
 * @property string|null $request_id
 * @property string $url
 * @property string $mime
 * @property bool|null $declined
 * @property int $likes
 * @method static Builder|UserImage newModelQuery()
 * @method static Builder|UserImage newQuery()
 * @method static Builder|UserImage query()
 * @method static Builder|UserImage whereAuthId($value)
 * @method static Builder|UserImage whereDeclined($value)
 * @method static Builder|UserImage whereId($value)
 * @method static Builder|UserImage whereLikes($value)
 * @method static Builder|UserImage whereMime($value)
 * @method static Builder|UserImage whereRequestId($value)
 * @method static Builder|UserImage whereUrl($value)
 * @mixin Eloquent
 */
class UserImage extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'user_images';

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
        'auth_id', 'request_id', 'url', 'mime', 'declined', 'likes'
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
