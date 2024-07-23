<?php

namespace App\Http\Controllers\Api\General\Alert;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\Alert\Interfaces\AlertImageControllerInterface;
use App\Http\Requests\Api\General\Alert\Image\DestroyManyRequest;
use App\Http\Requests\Api\General\Alert\Image\StoreManyRequest;
use App\Repositories\Alert\AlertImageRepository;
use App\Services\Alert\AlertImageService;
use App\Transformers\Api\Guest\Alert\AlertImageTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class AlertImageController
 *
 * @package App\Http\Controllers\Api\General\Alert
 */
final class AlertImageController extends BaseController implements AlertImageControllerInterface
{
    /**
     * @var AlertImageRepository
     */
    protected AlertImageRepository $alertImageRepository;

    /**
     * @var AlertImageService
     */
    protected AlertImageService $alertImageService;

    /**
     * AlertImageController constructor
     */
    public function __construct()
    {
        /** @var AlertImageRepository alertImageRepository */
        $this->alertImageRepository = new AlertImageRepository();

        /** @var AlertImageService alertImageService */
        $this->alertImageService = new AlertImageService();

        parent::__construct();
    }

    /**
     * @param int $alertId
     * @param StoreManyRequest $request
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function storeMany(
        int $alertId,
        StoreManyRequest $request
    ) : JsonResponse
    {
        /**
         * Getting alert images
         */
        $alertImages = $this->alertImageService->createImages(
            $alertId,
            $request->input('alert_images')
        );

        return $this->respondWithSuccess(
            $this->transformCollection($alertImages, new AlertImageTransformer),
            trans('validations/api/general/alert/image/storeMany.result.success')
        );
    }

    /**
     * @param DestroyManyRequest $request
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function destroyMany(
        DestroyManyRequest $request
    ) : JsonResponse
    {
        /**
         * Getting alert images
         */
        $alertImages = $this->alertImageRepository->getByIds(
            $request->input('alert_images_ids')
        );

        /**
         * Deleting alert images
         */
        $this->alertImageService->deleteImages(
            $alertImages
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/alert/image/destroyMany.result.success')
        );
    }
}
