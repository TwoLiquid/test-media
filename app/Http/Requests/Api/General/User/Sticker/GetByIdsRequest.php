<?php

namespace App\Http\Requests\Api\General\User\Sticker;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class GetByIdsRequest
 *
 * @package App\Http\Requests\Api\General\User\Sticker
 */
class GetByIdsRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'stickers_ids'   => 'required|array',
            'stickers_ids.*' => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'stickers_ids.required'   => trans('validations/api/general/user/sticker/getByIds.stickers_ids.required'),
            'stickers_ids.array'      => trans('validations/api/general/user/sticker/getByIds.stickers_ids.array'),
            'stickers_ids.*.required' => trans('validations/api/general/user/sticker/getByIds.stickers_ids.*.required'),
            'stickers_ids.*.string'   => trans('validations/api/general/user/sticker/getByIds.stickers_ids.*.string')
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation() : void
    {
        $params = $this->all();

        $this->merge([
            'stickers_ids' => isset($params['stickers_ids']) ? explodeUrlStrings($params['stickers_ids']) : null
        ]);
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
