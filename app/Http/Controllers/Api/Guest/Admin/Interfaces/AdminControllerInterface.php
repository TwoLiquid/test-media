<?php

namespace App\Http\Controllers\Api\Guest\Admin\Interfaces;

use App\Http\Requests\Api\Guest\Admin\GetForAdminsRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface AdminControllerInterface
 *
 * @package App\Http\Controllers\Api\Guest\Admin\Interfaces
 */
interface AdminControllerInterface
{
    /**
     * This method provides getting all rows
     * by related entity repository
     *
     * @param GetForAdminsRequest $request
     *
     * @return JsonResponse
     */
    public function getForAdmins(
        GetForAdminsRequest $request
    ) : JsonResponse;
}
