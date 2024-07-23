<?php

namespace App\Http\Controllers\Api\Guest\Vybe\Interfaces;

use App\Http\Requests\Api\Guest\Vybe\Video\ShowManyRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface VybeVideoControllerInterface
 * 
 * @package App\Http\Controllers\Api\Guest\Vybe\Interfaces
 */
interface VybeVideoControllerInterface
{
    /**
     * This method provides getting rows
     * by related entity repository
     *
     * @param ShowManyRequest $request
     *
     * @return JsonResponse
     */
    public function showMany(
        ShowManyRequest $request
    ) : JsonResponse;
}
