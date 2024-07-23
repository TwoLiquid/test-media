<?php

namespace App\Http\Requests\Api\General\User\Image;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class UpdateLikesRequest
 *
 * @package App\Http\Requests\Api\General\User\Image
 */
class UpdateLikesRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'likes' => 'required|integer'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'likes.required' => trans('validations/api/general/user/image/update.likes.required'),
            'likes.integer'  => trans('validations/api/general/user/image/update.likes.integer')
        ];
    }
}
