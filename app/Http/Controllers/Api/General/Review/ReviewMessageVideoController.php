<?php

namespace App\Http\Controllers\Api\General\Review;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\Review\Interfaces\ReviewMessageVideoControllerInterface;
use App\Http\Requests\Api\General\Review\Message\Video\DestroyManyRequest;
use App\Http\Requests\Api\General\Review\Message\Video\StoreManyRequest;
use App\Http\Requests\Api\General\Review\Message\Video\StoreRequest;
use App\Repositories\Review\ReviewMessageVideoRepository;
use App\Services\Review\ReviewMessageVideoService;
use App\Transformers\Api\General\Review\ReviewMessageVideoTransformer;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class ReviewMessageVideoController
 *
 * @package App\Http\Controllers\Api\General\Review
 */
final class ReviewMessageVideoController extends BaseController implements ReviewMessageVideoControllerInterface
{
    /**
     * @var ReviewMessageVideoRepository
     */
    protected ReviewMessageVideoRepository $reviewMessageVideoRepository;

    /**
     * @var ReviewMessageVideoService
     */
    protected ReviewMessageVideoService $reviewMessageVideoService;

    /**
     * ReviewMessageVideoController constructor
     */
    public function __construct()
    {
        /** @var ReviewMessageVideoRepository reviewMessageVideoRepository */
        $this->reviewMessageVideoRepository = new ReviewMessageVideoRepository();

        /** @var ReviewMessageVideoService reviewMessageVideoService */
        $this->reviewMessageVideoService = new ReviewMessageVideoService();

        parent::__construct();
    }

    /**
     * @param int $id
     *
     * @return BinaryFileResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function downloadFile(
        int $id
    ) : BinaryFileResponse
    {
        /**
         * Getting review message video
         */
        $reviewMessageVideo = $this->reviewMessageVideoRepository->findById($id);

        /**
         * Checking review message video existence
         */
        if (!$reviewMessageVideo) {
            throw new BaseException(
                trans('validations/api/general/review/message/video/downloadFile.result.error'),
                null,
                400
            );
        }

        return $this->respondWithDownload(
            $reviewMessageVideo->url
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
         * Creating review message video
         */
        $reviewMessageVideo = $this->reviewMessageVideoService->createVideo(
            $messageId,
            $request->input('content'),
            $request->input('mime'),
            $request->input('extension')
        );

        return $this->respondWithSuccess(
            $this->transformItem($reviewMessageVideo, new ReviewMessageVideoTransformer),
            trans('validations/api/general/review/message/video/store.result.success')
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
         * Creating review message videos
         */
        $reviewMessageVideos = $this->reviewMessageVideoService->createVideos(
            $messageId,
            $request->input('review_message_videos')
        );

        return $this->respondWithSuccess(
            $this->transformCollection($reviewMessageVideos, new ReviewMessageVideoTransformer),
            trans('validations/api/general/review/message/video/storeMany.result.success')
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
         * Getting review message videos
         */
        $reviewMessageVideos = $this->reviewMessageVideoRepository->getForMessageByIds(
            $messageId,
            $request->input('review_message_videos_ids')
        );

        /**
         * Checking review message videos
         */
        if ($reviewMessageVideos->isEmpty()) {
            return $this->respondWithError(
                trans('validations/api/general/review/message/video/destroyMany.result.error.find')
            );
        }

        /**
         * Deleting review message videos
         */
        $this->reviewMessageVideoService->deleteVideos(
            $reviewMessageVideos
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/review/message/video/destroyMany.result.success')
        );
    }
}
