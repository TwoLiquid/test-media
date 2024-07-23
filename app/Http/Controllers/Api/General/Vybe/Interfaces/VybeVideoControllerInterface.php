<?php

namespace App\Http\Controllers\Api\General\Vybe\Interfaces;

use App\Http\Requests\Api\General\Vybe\Video\DeclineManyRequest;
use App\Http\Requests\Api\General\Vybe\Video\DestroyManyRequest;
use App\Http\Requests\Api\General\Vybe\Video\StoreManyRequest;
use App\Http\Requests\Api\General\Vybe\Video\AcceptManyRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface VybeVideoControllerInterface
 *
 * @package App\Http\Controllers\Api\General\Vybe\Interfaces
 */
interface VybeVideoControllerInterface
{
    /**
     * This method provides storing rows
     * by related entity repository
     *
     * @param StoreManyRequest $request
     *
     * @return JsonResponse
     */
    public function storeMany(
        StoreManyRequest $request
    ) : JsonResponse;

    /**
     * This method provides updating rows
     * by related entity repository
     *
     * @param AcceptManyRequest $request
     *
     * @return JsonResponse
     */
    public function acceptMany(
        AcceptManyRequest $request
    ) : JsonResponse;

    /**
     * This method provides updating rows
     * by related entity repository
     *
     * @param DeclineManyRequest $request
     *
     * @return JsonResponse
     */
    public function declineMany(
        DeclineManyRequest $request
    ) : JsonResponse;

    /**
     * This method provides deleting rows
     * by related entity repository
     *
     * @param DestroyManyRequest $request
     *
     * @return JsonResponse
     */
    public function destroyMany(
        DestroyManyRequest $request
    ) : JsonResponse;
}