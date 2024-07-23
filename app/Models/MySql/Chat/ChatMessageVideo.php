<?php

namespace App\Models\MySql\Chat;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Eloquent;

/**
 * App\Models\MySql\Chat\ChatMessageVideo
 *
 * @property int $id
 * @property string $message_id
 * @property string $url
 * @property float $duration
 * @property float $size
 * @property string $mime
 * @property Carbon $created_at
 * @property-read ChatMessageVideoThumbnail|null $thumbnail
 * @method static Builder|ChatMessageVideo newModelQuery()
 * @method static Builder|ChatMessageVideo newQuery()
 * @method static Builder|ChatMessageVideo query()
 * @method static Builder|ChatMessageVideo whereCreatedAt($value)
 * @method static Builder|ChatMessageVideo whereDuration($value)
 * @method static Builder|ChatMessageVideo whereId($value)
 * @method static Builder|ChatMessageVideo whereMessageId($value)
 * @method static Builder|ChatMessageVideo whereMime($value)
 * @method static Builder|ChatMessageVideo whereSize($value)
 * @method static Builder|ChatMessageVideo whereUrl($value)
 * @mixin Eloquent
 */
class ChatMessageVideo extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'chat_message_videos';

    /**
     * Provide default timestamps usage
     *
     * @var bool
     */
    public $timestamps = [
        'created_at'
    ];

    /**
     * Excluding updated at
     */
    const UPDATED_AT = null;

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
            ChatMessageVideoThumbnail::class,
            'video_id',
            'id'
        );
    }
}
