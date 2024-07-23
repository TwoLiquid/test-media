<?php

namespace App\Models\MySql\Support;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Eloquent;

/**
 * App\Models\MySql\Support\SupportTicketMessageVideoThumbnail
 *
 * @property int $id
 * @property int $video_id
 * @property string $url
 * @property string $mime
 * @property-read SupportTicketMessageVideo $video
 * @method static Builder|SupportTicketMessageVideoThumbnail newModelQuery()
 * @method static Builder|SupportTicketMessageVideoThumbnail newQuery()
 * @method static Builder|SupportTicketMessageVideoThumbnail query()
 * @method static Builder|SupportTicketMessageVideoThumbnail whereId($value)
 * @method static Builder|SupportTicketMessageVideoThumbnail whereMime($value)
 * @method static Builder|SupportTicketMessageVideoThumbnail whereUrl($value)
 * @method static Builder|SupportTicketMessageVideoThumbnail whereVideoId($value)
 * @mixin Eloquent
 */
class SupportTicketMessageVideoThumbnail extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'support_ticket_message_video_thumbnails';

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
            SupportTicketMessageVideo::class,
            'video_id',
            'id'
        );
    }
}
