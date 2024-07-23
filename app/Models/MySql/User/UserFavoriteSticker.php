<?php

namespace App\Models\MySql\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Eloquent;

/**
 * App\Models\MySql\User\UserFavoriteSticker
 *
 * @property int $id
 * @property int $auth_id
 * @property string $external_id
 * @method static Builder|UserFavoriteSticker newModelQuery()
 * @method static Builder|UserFavoriteSticker newQuery()
 * @method static Builder|UserFavoriteSticker query()
 * @method static Builder|UserFavoriteSticker whereAuthId($value)
 * @method static Builder|UserFavoriteSticker whereExternalId($value)
 * @method static Builder|UserFavoriteSticker whereId($value)
 * @mixin Eloquent
 */
class UserFavoriteSticker extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'user_favorite_stickers';

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
        'auth_id', 'external_id'
    ];
}
