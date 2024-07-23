<?php

namespace App\Models\MySql\Review;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Eloquent;

/**
 * App\Models\MySql\Review\ReviewMessageVideo
 *
 * @property int $id
 * @property string $message_id
 * @property string $url
 * @property float $duration
 * @property float $size
 * @property string $mime
 * @property-read ReviewMessageVideoThumbnail|null $thumbnail
 * @method static Builder|ReviewMessageVideo newModelQuery()
 * @method static Builder|ReviewMessageVideo newQuery()
 * @method static Builder|ReviewMessageVideo query()
 * @method static Builder|ReviewMessageVideo whereCreatedAt($value)
 * @method static Builder|ReviewMessageVideo whereDuration($value)
 * @method static Builder|ReviewMessageVideo whereId($value)
 * @method static Builder|ReviewMessageVideo whereMessageId($value)
 * @method static Builder|ReviewMessageVideo whereMime($value)
 * @method static Builder|ReviewMessageVideo whereSize($value)
 * @method static Builder|ReviewMessageVideo whereUrl($value)
 * @mixin Eloquent
 */
class ReviewMessageVideo extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'review_message_videos';

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
        'message_id', 'url', 'duration', 'size', 'mime'
    ];

    //--------------------------------------------------------------------------
    // Has one relations

    /**
     * @return HasOne
     */
    public function thumbnail() : HasOne
    {
        return $this->hasOne(
            ReviewMessageVideoThumbnail::class,
            'video_id',
            'id'
        );
    }
}
