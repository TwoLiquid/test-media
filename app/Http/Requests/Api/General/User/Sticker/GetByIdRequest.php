<?php

namespace App\Http\Requests\Api\General\User\Sticker;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class GetByIdRequest
 *
 * @package App\Http\Requests\Api\General\User\Sticker
 */
class GetByIdRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'sticker_id' => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'sticker_id.required' => trans('validations/api/general/user/sticker/getById.sticker_id.required'),
            'sticker_id.string'   => trans('validations/api/general/user/sticker/getById.sticker_id.string')
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
