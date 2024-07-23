<?php

namespace App\Http\Controllers\Api\Guest\Auth;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\Guest\Auth\Interfaces\AuthControllerInterface;
use Illuminate\Http\JsonResponse;

/**
 * Class AuthController
 *
 * @package App\Http\Controllers\Api\Guest\Auth
 */
final class AuthController extends BaseController implements AuthControllerInterface
{
    /**
     * @return JsonResponse
     */
    public function test() : JsonResponse
    {
        return $this->respondWithSuccess([],
            trans('validations/api/guest/auth/test.result.success')
        );
    }
}
