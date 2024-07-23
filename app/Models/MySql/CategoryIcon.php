<?php

namespace App\Models\MySql;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Eloquent;

/**
 * App\Models\MySql\CategoryIcon
 *
 * @property int $id
 * @property int $category_id
 * @property string $url
 * @property string $mime
 * @method static Builder|CategoryIcon newModelQuery()
 * @method static Builder|CategoryIcon newQuery()
 * @method static Builder|CategoryIcon query()
 * @method static Builder|CategoryIcon whereCategoryId($value)
 * @method static Builder|CategoryIcon whereId($value)
 * @method static Builder|CategoryIcon whereMime($value)
 * @method static Builder|CategoryIcon whereUrl($value)
 * @mixin Eloquent
 */
class CategoryIcon extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'category_icons';

    /**
     * Provide default timestamps usage
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'url', 'mime'
    ];
}
