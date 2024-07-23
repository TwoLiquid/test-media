<?php

namespace App\Models\MySql\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Eloquent;

/**
 * App\Models\MySql\User\UserVoiceSample
 *
 * @property int $id
 * @property int $auth_id
 * @property string|null $request_id
 * @property string $url
 * @property float|null $duration
 * @property string $mime
 * @property bool|null $declined
 * @method static Builder|UserVoiceSample newModelQuery()
 * @method static Builder|UserVoiceSample newQuery()
 * @method static Builder|UserVoiceSample query()
 * @method static Builder|UserVoiceSample whereAuthId($value)
 * @method static Builder|UserVoiceSample whereDeclined($value)
 * @method static Builder|UserVoiceSample whereDuration($value)
 * @method static Builder|UserVoiceSample whereId($value)
 * @method static Builder|UserVoiceSample whereMime($value)
 * @method static Builder|UserVoiceSample whereRequestId($value)
 * @method static Builder|UserVoiceSample whereUrl($value)
 * @mixin Eloquent
 */
class UserVoiceSample extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'user_voice_samples';

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
        'auth_id', 'request_id', 'url', 'duration', 'mime', 'declined'
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
