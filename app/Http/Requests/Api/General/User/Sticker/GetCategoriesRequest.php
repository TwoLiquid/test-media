<?php

namespace App\Http\Requests\Api\General\User\Sticker;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class GetCategoriesRequest
 *
 * @package App\Http\Requests\Api\General\User\Sticker
 */
class GetCategoriesRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'type' => 'required|string|in:featured,trending'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'type.required' => trans('validations/api/general/user/sticker/getCategories.type.required'),
            'type.string'   => trans('validations/api/general/user/sticker/getCategories.type.string'),
            'type.in'       => trans('validations/api/general/user/sticker/getCategories.type.in')
        ];
    }

    /**
     * @param null $keys
     *
     * @return array
     */
    public function all($keys = null) : array
    {
        return array_merge(
            parent::all(),
            $this->route()->parameters()
        );
    }
}
