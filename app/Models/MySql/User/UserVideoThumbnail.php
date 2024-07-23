<?php

namespace App\Models\MySql\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Eloquent;

/**
 * App\Models\MySql\User\UserVideoThumbnail
 *
 * @property int $id
 * @property int $video_id
 * @property string $url
 * @property string $mime
 * @property-read UserVideo $video
 * @method static Builder|UserVideoThumbnail newModelQuery()
 * @method static Builder|UserVideoThumbnail newQuery()
 * @method static Builder|UserVideoThumbnail query()
 * @method static Builder|UserVideoThumbnail whereId($value)
 * @method static Builder|UserVideoThumbnail whereMime($value)
 * @method static Builder|UserVideoThumbnail whereUrl($value)
 * @method static Builder|UserVideoThumbnail whereVideoId($value)
 * @mixin Eloquent
 */
class UserVideoThumbnail extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'user_video_thumbnails';

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
        'video_id', 'url', 'mime'
    ];

    //--------------------------------------------------------------------------
    // Belongs to relations

    /**
     * @return BelongsTo
     */
    public function video() : BelongsTo
    {
        return $this->belongsTo(
            UserVideo::class,
            'video_id',
            'id'
        );
    }
}
