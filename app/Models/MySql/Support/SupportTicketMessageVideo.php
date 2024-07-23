<?php

namespace App\Models\MySql\Support;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Eloquent;

/**
 * App\Models\MySql\Support\SupportTicketMessageVideo
 *
 * @property int $id
 * @property string $message_id
 * @property string $url
 * @property float $duration
 * @property float $size
 * @property string $mime
 * @property Carbon $created_at
 * @property-read SupportTicketMessageVideoThumbnail|null $thumbnail
 * @method static Builder|SupportTicketMessageVideo newModelQuery()
 * @method static Builder|SupportTicketMessageVideo newQuery()
 * @method static Builder|SupportTicketMessageVideo query()
 * @method static Builder|SupportTicketMessageVideo whereCreatedAt($value)
 * @method static Builder|SupportTicketMessageVideo whereDuration($value)
 * @method static Builder|SupportTicketMessageVideo whereId($value)
 * @method static Builder|SupportTicketMessageVideo whereMessageId($value)
 * @method static Builder|SupportTicketMessageVideo whereMime($value)
 * @method static Builder|SupportTicketMessageVideo whereSize($value)
 * @method static Builder|SupportTicketMessageVideo whereUrl($value)
 * @mixin Eloquent
 */
class SupportTicketMessageVideo extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'support_ticket_message_videos';

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
            SupportTicketMessageVideoThumbnail::class,
            'video_id',
            'id'
        );
    }
}
