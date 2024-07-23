<?php

namespace App\Models\MySql\Chat;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Eloquent;

/**
 * App\Models\MySql\Chat\ChatMessageAudio
 *
 * @property int $id
 * @property string $message_id
 * @property string $url
 * @property float|null $duration
 * @property float|null $size
 * @property string $mime
 * @property Carbon $created_at
 * @method static Builder|ChatMessageAudio newModelQuery()
 * @method static Builder|ChatMessageAudio newQuery()
 * @method static Builder|ChatMessageAudio query()
 * @method static Builder|ChatMessageAudio whereCreatedAt($value)
 * @method static Builder|ChatMessageAudio whereDuration($value)
 * @method static Builder|ChatMessageAudio whereId($value)
 * @method static Builder|ChatMessageAudio whereMessageId($value)
 * @method static Builder|ChatMessageAudio whereMime($value)
 * @method static Builder|ChatMessageAudio whereOriginalName($value)
 * @method static Builder|ChatMessageAudio whereSize($value)
 * @method static Builder|ChatMessageAudio whereUrl($value)
 * @property string|null $original_name
 * @mixin Eloquent
 */
class ChatMessageAudio extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'chat_message_audios';

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
}
