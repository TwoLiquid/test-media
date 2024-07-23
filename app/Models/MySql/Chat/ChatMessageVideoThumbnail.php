<?php

namespace App\Models\MySql\Chat;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Eloquent;

/**
 * App\Models\MySql\Chat\ChatMessageVideoThumbnail
 *
 * @property int $id
 * @property int $video_id
 * @property string $url
 * @property string $mime
 * @property-read ChatMessageVideo $video
 * @method static Builder|ChatMessageVideoThumbnail newModelQuery()
 * @method static Builder|ChatMessageVideoThumbnail newQuery()
 * @method static Builder|ChatMessageVideoThumbnail query()
 * @method static Builder|ChatMessageVideoThumbnail whereId($value)
 * @method static Builder|ChatMessageVideoThumbnail whereMime($value)
 * @method static Builder|ChatMessageVideoThumbnail whereUrl($value)
 * @method static Builder|ChatMessageVideoThumbnail whereVideoId($value)
 * @mixin Eloquent
 */
class ChatMessageVideoThumbnail extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'chat_message_video_thumbnails';

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
            ChatMessageVideo::class,
            'video_id',
            'id'
        );
    }
}
