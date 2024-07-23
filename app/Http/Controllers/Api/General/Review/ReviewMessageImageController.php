<?php

namespace App\Http\Controllers\Api\General\Review;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\Review\Interfaces\ReviewMessageImageControllerInterface;
use App\Http\Requests\Api\General\Review\Message\Image\DestroyManyRequest;
use App\Http\Requests\Api\General\Review\Message\Image\StoreManyRequest;
use App\Http\Requests\Api\General\Review\Message\Image\StoreRequest;
use App\Repositories\Review\ReviewMessageImageRepository;
use App\Services\Review\ReviewMessageImageService;
use App\Transformers\Api\General\Review\ReviewMessageImageTransformer;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class ReviewMessageImageController
 *
 * @package App\Http\Controllers\Api\General\Review
 */
final class ReviewMessageImageController extends BaseController implements ReviewMessageImageControllerInterface
{
    /**
     * @var ReviewMessageImageRepository
     */
    protected ReviewMessageImageRepository $reviewMessageImageRepository;

    /**
     * @var ReviewMessageImageService
     */
    protected ReviewMessageImageService $reviewMessageImageService;

    /**
     * ReviewMessageImageController constructor
     */
    public function __construct()
    {
        /** @var ReviewMessageImageRepository reviewMessageImageRepository */
        $this->reviewMessageImageRepository = new ReviewMessageImageRepository();

        /** @var ReviewMessageImageService reviewMessageImageService */
        $this->reviewMessageImageService = new ReviewMessageImageService();

        parent::__construct();
    }

    /**
     * @param int $id
     *
     * @return BinaryFileResponse|null
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function downloadFile(
        int $id
    ) : ?BinaryFileResponse
    {
        /**
         * Getting review message image
         */
        $reviewMessageImage = $this->reviewMessageImageRepository->findById($id);

        /**
         * Checking review message image existence
         */
        if (!$reviewMessageImage) {
            throw new BaseException(
                trans('validations/api/general/review/message/image/downloadFile.result.error'),
                null,
                400
            );
        }

        return $this->respondWithDownload(
            $reviewMessageImage->url
        );
    }

    /**
     * @param int $id
     *
     * @return BinaryFileResponse|null
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function downloadMinFile(
        int $id
    ) : ?BinaryFileResponse
    {
        /**
         * Getting review message image
         */
        $reviewMessageImage = $this->reviewMessageImageRepository->findById($id);

        /**
         * Checking review message image existence
         */
        if (!$reviewMessageImage) {
            throw new BaseException(
                trans('validations/api/general/review/message/image/downloadMinFile.result.error'),
                null,
                400
            );
        }

        return $this->respondWithDownload(
            getMinimizedFilePath($reviewMessageImage->url)
        );
    }

    /**
     * @param string $messageId
     * @param StoreRequest $request
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function store(
        string $messageId,
        StoreRequest $request
    ) : JsonResponse
    {
        /**
         * Creating review message image
         */
        $reviewMessageImage = $this->reviewMessageImageService->createImage(
            $messageId,
            $request->input('content'),
            $request->input('mime'),
            $request->input('extension')
        );

        return $this->respondWithSuccess(
            $this->transformItem($reviewMessageImage, new ReviewMessageImageTransformer),
            trans('validations/api/general/review/message/image/store.result.success')
        );
    }

    /**
     * @param string $messageId
     * @param StoreManyRequest $request
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function storeMany(
        string $messageId,
        StoreManyRequest $request
    ) : JsonResponse
    {
        /**
         * Creating review message images
         */
        $reviewMessageImages = $this->reviewMessageImageService->createImages(
            $messageId,
            $request->input('review_message_images')
        );

        return $this->respondWithSuccess(
            $this->transformCollection($reviewMessageImages, new ReviewMessageImageTransformer),
            trans('validations/api/general/review/message/image/storeMany.result.success')
        );
    }

    /**
     * @param string $messageId
     * @param DestroyManyRequest $request
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function destroyMany(
        string $messageId,
        DestroyManyRequest $request
    ) : JsonResponse
    {
        /**
         * Getting review message images
         */
        $reviewMessageImages = $this->reviewMessageImageRepository->getForMessageByIds(
            $messageId,
            $request->input('review_message_images_ids')
        );

        /**
         * Checking review message images
         */
        if ($reviewMessageImages->isEmpty()) {
            return $this->respondWithError(
                trans('validations/api/general/review/message/image/destroyMany.result.error.find')
            );
        }

        /**
         * Deleting review message images
         */
        $this->reviewMessageImageService->deleteImages(
            $reviewMessageImages
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/review/message/image/destroyMany.result.success')
        );
    }
}
