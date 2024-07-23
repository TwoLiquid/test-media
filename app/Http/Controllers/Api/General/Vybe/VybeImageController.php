<?php

namespace App\Http\Controllers\Api\General\Vybe;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\Vybe\Interfaces\VybeImageControllerInterface;
use App\Http\Requests\Api\General\Vybe\Image\AcceptManyRequest;
use App\Http\Requests\Api\General\Vybe\Image\DeclineManyRequest;
use App\Http\Requests\Api\General\Vybe\Image\DestroyManyRequest;
use App\Http\Requests\Api\General\Vybe\Image\StoreManyRequest;
use App\Repositories\Vybe\VybeImageRepository;
use App\Services\Vybe\VybeImageService;
use App\Transformers\Api\General\Vybe\VybeImageTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class VybeImageController
 *
 * @package App\Http\Controllers\Api\General\Vybe
 */
final class VybeImageController extends BaseController implements VybeImageControllerInterface
{
    /**
     * @var VybeImageRepository
     */
    protected VybeImageRepository $vybeImageRepository;

    /**
     * @var VybeImageService
     */
    protected VybeImageService $vybeImageService;

    /**
     * VybeImageController constructor
     */
    public function __construct()
    {
        /** @var VybeImageRepository vybeImageRepository */
        $this->vybeImageRepository = new VybeImageRepository();

        /** @var VybeImageService vybeImageService */
        $this->vybeImageService = new VybeImageService();

        parent::__construct();
    }

    /**
     * @param StoreManyRequest $request
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function storeMany(
        StoreManyRequest $request
    ) : JsonResponse
    {
        /**
         * Creating vybe images
         */
        $vybeImages = $this->vybeImageService->createImages(
            $request->input('vybe_images')
        );

        return $this->respondWithSuccess(
            $this->transformCollection($vybeImages, new VybeImageTransformer),
            trans('validations/api/general/vybe/image/storeMany.result.success')
        );
    }

    /**
     * @param AcceptManyRequest $request
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function acceptMany(
        AcceptManyRequest $request
    ) : JsonResponse
    {
        /**
         * Getting vybe images
         */
        $vybeImages = $this->vybeImageRepository->getByIds(
            $request->input('vybe_images_ids')
        );

        /**
         * Updating vybe images
         */
        $this->vybeImageService->acceptImages(
            $vybeImages
        );

        return $this->respondWithSuccess(
            $this->transformCollection($vybeImages, new VybeImageTransformer),
            trans('validations/api/general/vybe/image/acceptMany.result.success')
        );
    }

    /**
     * @param DeclineManyRequest $request
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function declineMany(
        DeclineManyRequest $request
    ) : JsonResponse
    {
        /**
         * Getting vybe images
         */
        $vybeImages = $this->vybeImageRepository->getByIds(
            $request->input('vybe_images_ids')
        );

        /**
         * Updating vybe images
         */
        $this->vybeImageService->declineImages(
            $vybeImages
        );

        return $this->respondWithSuccess(
            $this->transformCollection($vybeImages, new VybeImageTransformer),
            trans('validations/api/general/vybe/image/declineMany.result.success')
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
         * Getting vybe images
         */
        $vybeImages = $this->vybeImageRepository->getByIds(
            $request->input('vybe_images_ids')
        );

        /**
         * Deleting vybe images
         */
        $this->vybeImageService->deleteImages(
            $vybeImages
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/vybe/image/destroyMany.result.success')
        );
    }
}
