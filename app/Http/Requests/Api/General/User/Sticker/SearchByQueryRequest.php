<?php

namespace App\Http\Requests\Api\General\User\Sticker;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class SearchByQueryRequest
 *
 * @package App\Http\Requests\Api\General\User\Sticker
 */
class SearchByQueryRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'query' => 'required|string',
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
            'query.required' => trans('validations/api/general/user/sticker/searchByQuery.query.required'),
            'query.string'   => trans('validations/api/general/user/sticker/searchByQuery.query.string'),
            'limit.required' => trans('validations/api/general/user/sticker/searchByQuery.limit.required'),
            'limit.integer'  => trans('validations/api/general/user/sticker/searchByQuery.limit.integer'),
            'next.string'    => trans('validations/api/general/user/sticker/searchByQuery.next.string')
        ];
    }

//    /**
//     * Prepare the data for validation.
//     *
//     * @return void
//     */
//    protected function prepareForValidation() : void
//    {
//        $params = $this->all();
//
//        $this->merge([
//            'random' => isset($params['random']) ? (bool) $params['random'] : null
//        ]);
//    }

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
