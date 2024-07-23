<?php

namespace App\Http\Controllers\Api\Guest\Platform;

use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\Guest\Platform\Interfaces\PlatformIconControllerInterface;
use App\Http\Requests\Api\Guest\Platform\Icon\GetForPlatformsRequest;
use App\Repositories\Platform\PlatformIconRepository;
use App\Transformers\Api\Guest\Platform\PlatformIconTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class PlatformIconController
 *
 * @package App\Http\Controllers\Api\Guest\Platform
 */
final class PlatformIconController extends BaseController implements PlatformIconControllerInterface
{
    /**
     * @var PlatformIconRepository
     */
    protected PlatformIconRepository $platformIconRepository;

    /**
     * PlatformController constructor
     */
    public function __construct()
    {
        /** @var PlatformIconRepository platformIconRepository */
        $this->platformIconRepository = new PlatformIconRepository();

        parent::__construct();
    }

    /**
     * @param int $platformId
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function getForPlatform(
        int $platformId
    ) : JsonResponse
    {
        /**
         * Getting platform icons
         */
        $platformIcons = $this->platformIconRepository->getForPlatform(
            $platformId
        );

        return $this->respondWithSuccess(
            $this->transformCollection($platformIcons, new PlatformIconTransformer),
            trans('validations/api/guest/platform/icon/getForPlatform.result.success')
        );
    }

    /**
     * @param GetForPlatformsRequest $request
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function getForPlatforms(
        GetForPlatformsRequest $request
    ) : JsonResponse
    {
        /**
         * Getting platform icons
         */
        $platformIcons = $this->platformIconRepository->getForPlatforms(
            $request->input('platforms_ids')
        );

        return $this->respondWithSuccess(
            $this->transformCollection($platformIcons, new PlatformIconTransformer),
            trans('validations/api/guest/platform/icon/getForPlatforms.result.success')
        );
    }
}
