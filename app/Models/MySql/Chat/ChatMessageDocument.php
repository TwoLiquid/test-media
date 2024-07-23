<?php

namespace App\Models\MySql\Chat;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Eloquent;

/**
 * App\Models\MySql\Chat\ChatMessageDocument
 *
 * @property int $id
 * @property string $message_id
 * @property string $url
 * @property string|null $original_name
 * @property float $size
 * @property string $mime
 * @property Carbon $created_at
 * @method static Builder|ChatMessageDocument newModelQuery()
 * @method static Builder|ChatMessageDocument newQuery()
 * @method static Builder|ChatMessageDocument query()
 * @method static Builder|ChatMessageDocument whereCreatedAt($value)
 * @method static Builder|ChatMessageDocument whereId($value)
 * @method static Builder|ChatMessageDocument whereMessageId($value)
 * @method static Builder|ChatMessageDocument whereMime($value)
 * @method static Builder|ChatMessageDocument whereOriginalName($value)
 * @method static Builder|ChatMessageDocument whereSize($value)
 * @method static Builder|ChatMessageDocument whereUrl($value)
 * @mixin Eloquent
 */
class ChatMessageDocument extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'chat_message_documents';

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
        'message_id', 'url', 'original_name', 'size', 'mime'
    ];
}
