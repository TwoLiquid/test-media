<?php

namespace App\Models\MySql\Review;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Eloquent;

/**
 * App\Models\MySql\Review\ReviewMessageVideoThumbnail
 *
 * @property int $id
 * @property int $video_id
 * @property string $url
 * @property string $mime
 * @property-read ReviewMessageVideo $video
 * @method static Builder|ReviewMessageVideoThumbnail newModelQuery()
 * @method static Builder|ReviewMessageVideoThumbnail newQuery()
 * @method static Builder|ReviewMessageVideoThumbnail query()
 * @method static Builder|ReviewMessageVideoThumbnail whereId($value)
 * @method static Builder|ReviewMessageVideoThumbnail whereMime($value)
 * @method static Builder|ReviewMessageVideoThumbnail whereUrl($value)
 * @method static Builder|ReviewMessageVideoThumbnail whereVideoId($value)
 * @mixin Eloquent
 */
class ReviewMessageVideoThumbnail extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'review_message_video_thumbnails';

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
            ReviewMessageVideo::class,
            'video_id',
            'id'
        );
    }
}
