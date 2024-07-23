<?php

namespace App\Http\Controllers\Api\Guest\Search\Interfaces;

use App\Http\Requests\Api\Guest\Search\GetForClientGlobalRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface SearchControllerInterface
 *
 * @package App\Http\Controllers\Api\Guest\Search\Interfaces
 */
interface SearchControllerInterface
{
    /**
     * This method provides getting all rows
     * by related entity repository
     *
     * @param GetForClientGlobalRequest $request
     *
     * @return JsonResponse
     */
    public function getForClientGlobal(
        GetForClientGlobalRequest $request
    ) : JsonResponse;
}
