<?php

namespace App\Models\MySql\Support;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Eloquent;

/**
 * App\Models\MySql\Support\SupportTicketMessageDocument
 *
 * @property int $id
 * @property string $message_id
 * @property string $url
 * @property string|null $original_name
 * @property float $size
 * @property string $mime
 * @property Carbon $created_at
 * @method static Builder|SupportTicketMessageDocument newModelQuery()
 * @method static Builder|SupportTicketMessageDocument newQuery()
 * @method static Builder|SupportTicketMessageDocument query()
 * @method static Builder|SupportTicketMessageDocument whereCreatedAt($value)
 * @method static Builder|SupportTicketMessageDocument whereId($value)
 * @method static Builder|SupportTicketMessageDocument whereMessageId($value)
 * @method static Builder|SupportTicketMessageDocument whereMime($value)
 * @method static Builder|SupportTicketMessageDocument whereOriginalName($value)
 * @method static Builder|SupportTicketMessageDocument whereSize($value)
 * @method static Builder|SupportTicketMessageDocument whereUrl($value)
 * @mixin Eloquent
 */
class SupportTicketMessageDocument extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'support_ticket_message_documents';

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
