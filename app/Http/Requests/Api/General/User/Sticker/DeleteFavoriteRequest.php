<?php

namespace App\Http\Requests\Api\General\User\Sticker;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class DeleteFavoriteRequest
 *
 * @package App\Http\Requests\Api\General\User\Sticker
 */
class DeleteFavoriteRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'external_id' => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'external_id.required' => trans('validations/api/general/user/sticker/deleteFavorite.external_id.required'),
            'external_id.string'   => trans('validations/api/general/user/sticker/deleteFavorite.external_id.string')
        ];
    }
}
