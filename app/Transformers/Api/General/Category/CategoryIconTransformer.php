<?php

namespace App\Transformers\Api\General\Category;

use App\Models\MySql\CategoryIcon;
use App\Transformers\BaseTransformer;

/**
 * Class CategoryIconTransformer
 *
 * @package App\Transformers\Api\General\Category
 */
class CategoryIconTransformer extends BaseTransformer
{
    /**
     * @param CategoryIcon $categoryIcon
     *
     * @return array
     */
    public function transform(CategoryIcon $categoryIcon) : array
    {
        return [
            'id'          => $categoryIcon->id,
            'category_id' => $categoryIcon->category_id,
            'url'         => generateFullStorageLink($categoryIcon->url),
            'mime'        => $categoryIcon->mime
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'category_icon';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'category_icons';
    }
}
