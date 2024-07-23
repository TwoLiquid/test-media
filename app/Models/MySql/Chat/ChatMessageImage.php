<?php

namespace App\Models\MySql\Chat;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Eloquent;

/**
 * App\Models\MySql\Chat\ChatMessageImage
 *
 * @property int $id
 * @property string $message_id
 * @property string $url
 * @property float $size
 * @property string $mime
 * @property Carbon $created_at
 * @method static Builder|ChatMessageImage newModelQuery()
 * @method static Builder|ChatMessageImage newQuery()
 * @method static Builder|ChatMessageImage query()
 * @method static Builder|ChatMessageImage whereCreatedAt($value)
 * @method static Builder|ChatMessageImage whereId($value)
 * @method static Builder|ChatMessageImage whereMessageId($value)
 * @method static Builder|ChatMessageImage whereMime($value)
 * @method static Builder|ChatMessageImage whereSize($value)
 * @method static Builder|ChatMessageImage whereUrl($value)
 * @mixin Eloquent
 */
class ChatMessageImage extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'chat_message_images';

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
        'message_id', 'url', 'size', 'mime'
    ];
}
