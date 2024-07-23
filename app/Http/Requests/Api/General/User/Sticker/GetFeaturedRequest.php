<?php

namespace App\Http\Requests\Api\General\User\Sticker;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class GetFeaturedRequest
 *
 * @package App\Http\Requests\Api\General\User\Sticker
 */
class GetFeaturedRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'limit' => 'required|integer',
            'next'  => 'string|nullable'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'limit.required' => trans('validations/api/general/user/sticker/getFeatured.limit.required'),
            'limit.integer'  => trans('validations/api/general/user/sticker/getFeatured.limit.integer'),
            'next.string'    => trans('validations/api/general/user/sticker/getFeatured.next.string')
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
