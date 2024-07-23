<?php

namespace App\Http\Controllers\Api\Guest\Vybe\Interfaces;

use App\Http\Requests\Api\Guest\Vybe\Image\ShowManyRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface VybeImageControllerInterface
 *
 * @package App\Http\Controllers\Api\Guest\Vybe\Interfaces
 */
interface VybeImageControllerInterface
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
