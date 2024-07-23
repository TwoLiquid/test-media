<?php

namespace App\Http\Controllers\Api\General\Platform;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\Platform\Interfaces\PlatformIconControllerInterface;
use App\Http\Requests\Api\General\Platform\Icon\StoreRequest;
use App\Repositories\Platform\PlatformIconRepository;
use App\Services\Platform\PlatformIconService;
use App\Transformers\Api\General\Platform\PlatformIconTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class PlatformIconController
 *
 * @package App\Http\Controllers\Api\General\Platform
 */
final class PlatformIconController extends BaseController implements PlatformIconControllerInterface
{
    /**
     * @var PlatformIconRepository
     */
    protected PlatformIconRepository $platformIconRepository;

    /**
     * @var PlatformIconService
     */
    protected PlatformIconService $platformIconService;

    /**
     * PlatformIconController constructor
     */
    public function __construct()
    {
        /** @var PlatformIconRepository platformIconRepository */
        $this->platformIconRepository = new PlatformIconRepository();

        /** @var PlatformIconService platformIconService */
        $this->platformIconService = new PlatformIconService();

        parent::__construct();
    }

    /**
     * @param int $platformId
     * @param StoreRequest $request
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function store(
        int $platformId,
        StoreRequest $request
    ) : JsonResponse
    {
        /**
         * Creating platform icon
         */
        $platformIcon = $this->platformIconService->createIcon(
            $platformId,
            $request->input('content'),
            $request->input('mime'),
            $request->input('extension')
        );

        return $this->respondWithSuccess(
            $this->transformItem($platformIcon, new PlatformIconTransformer),
            trans('validations/api/general/platform/icon/store.result.success')
        );
    }

    /**
     * @param int $platformId
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function destroy(
        int $platformId
    ) : JsonResponse
    {
        /**
         * Getting platform icons
         */
        $platformIcons = $this->platformIconRepository->getForPlatform(
            $platformId
        );

        /**
         * Deleting platform icons
         */
        $this->platformIconService->deleteIcons(
            $platformIcons
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/platform/icon/destroy.result.success')
        );
    }
}
