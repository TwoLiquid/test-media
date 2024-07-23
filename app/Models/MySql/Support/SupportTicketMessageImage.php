<?php

namespace App\Models\MySql\Support;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Eloquent;

/**
 * App\Models\MySql\Support\SupportTicketMessageImage
 *
 * @property int $id
 * @property string $message_id
 * @property string $url
 * @property float $size
 * @property string $mime
 * @property Carbon $created_at
 * @method static Builder|SupportTicketMessageImage newModelQuery()
 * @method static Builder|SupportTicketMessageImage newQuery()
 * @method static Builder|SupportTicketMessageImage query()
 * @method static Builder|SupportTicketMessageImage whereCreatedAt($value)
 * @method static Builder|SupportTicketMessageImage whereId($value)
 * @method static Builder|SupportTicketMessageImage whereMessageId($value)
 * @method static Builder|SupportTicketMessageImage whereMime($value)
 * @method static Builder|SupportTicketMessageImage whereSize($value)
 * @method static Builder|SupportTicketMessageImage whereUrl($value)
 * @mixin Eloquent
 */
class SupportTicketMessageImage extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'support_ticket_message_images';

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
