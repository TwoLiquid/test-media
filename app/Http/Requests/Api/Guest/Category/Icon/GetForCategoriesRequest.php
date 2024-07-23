<?php

namespace App\Http\Requests\Api\Guest\Category\Icon;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class GetForCategoriesRequest
 *
 * @package App\Http\Requests\Api\Guest\Category\Icon
 */
class GetForCategoriesRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'categories_ids'   => 'required|array',
            'categories_ids.*' => 'required|integer'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'categories_ids.required'   => trans('validations/api/guest/category/icon/getForCategories.categories_ids.required'),
            'categories_ids.array'      => trans('validations/api/guest/category/icon/getForCategories.categories_ids.array'),
            'categories_ids.*.required' => trans('validations/api/guest/category/icon/getForCategories.categories_ids.*.required'),
            'categories_ids.*.integer'  => trans('validations/api/guest/category/icon/getForCategories.categories_ids.*.integer'),
            'categories_ids.*.exists'   => trans('validations/api/guest/category/icon/getForCategories.categories_ids.*.exists')
        ];
    }
}
