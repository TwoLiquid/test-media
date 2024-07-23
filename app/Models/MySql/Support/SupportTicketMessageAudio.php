<?php

namespace App\Models\MySql\Support;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Eloquent;

/**
 * App\Models\MySql\Support\SupportTicketMessageAudio
 *
 * @property int $id
 * @property string $message_id
 * @property string $url
 * @property string|null $original_name
 * @property float|null $duration
 * @property float|null $size
 * @property string $mime
 * @property Carbon $created_at
 * @method static Builder|SupportTicketMessageAudio newModelQuery()
 * @method static Builder|SupportTicketMessageAudio newQuery()
 * @method static Builder|SupportTicketMessageAudio query()
 * @method static Builder|SupportTicketMessageAudio whereCreatedAt($value)
 * @method static Builder|SupportTicketMessageAudio whereDuration($value)
 * @method static Builder|SupportTicketMessageAudio whereId($value)
 * @method static Builder|SupportTicketMessageAudio whereMessageId($value)
 * @method static Builder|SupportTicketMessageAudio whereMime($value)
 * @method static Builder|SupportTicketMessageAudio whereOriginalName($value)
 * @method static Builder|SupportTicketMessageAudio whereSize($value)
 * @method static Builder|SupportTicketMessageAudio whereUrl($value)
 * @mixin Eloquent
 */
class SupportTicketMessageAudio extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'support_ticket_message_audios';

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
