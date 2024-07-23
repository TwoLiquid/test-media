<?php

namespace App\Models\MySql\Review;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Eloquent;

/**
 * App\Models\MySql\Review\ReviewMessageImage
 *
 * @property int $id
 * @property string $message_id
 * @property string $url
 * @property float $size
 * @property string $mime
 * @method static Builder|ReviewMessageImage newModelQuery()
 * @method static Builder|ReviewMessageImage newQuery()
 * @method static Builder|ReviewMessageImage query()
 * @method static Builder|ReviewMessageImage whereCreatedAt($value)
 * @method static Builder|ReviewMessageImage whereId($value)
 * @method static Builder|ReviewMessageImage whereMessageId($value)
 * @method static Builder|ReviewMessageImage whereMime($value)
 * @method static Builder|ReviewMessageImage whereSize($value)
 * @method static Builder|ReviewMessageImage whereUrl($value)
 * @mixin Eloquent
 */
class ReviewMessageImage extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'review_message_images';

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
        'message_id', 'url', 'size', 'mime'
    ];
}
