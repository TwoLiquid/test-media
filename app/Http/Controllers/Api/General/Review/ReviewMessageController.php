<?php

namespace App\Http\Controllers\Api\General\Review;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\Review\Interfaces\ReviewMessageControllerInterface;
use App\Http\Requests\Api\General\Review\Message\GetForReviewMessagesRequest;
use App\Repositories\Review\ReviewMessageImageRepository;
use App\Repositories\Review\ReviewMessageVideoRepository;
use App\Repositories\User\UserAvatarRepository;
use App\Services\Review\ReviewMessageImageService;
use App\Services\Review\ReviewMessageVideoService;
use App\Transformers\Api\General\Review\ReviewMessageTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class ReviewMessageController
 *
 * @package App\Http\Controllers\Api\General\Review
 */
final class ReviewMessageController extends BaseController implements ReviewMessageControllerInterface
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
     * @var ReviewMessageVideoRepository
     */
    protected ReviewMessageVideoRepository $reviewMessageVideoRepository;

    /**
     * @var ReviewMessageVideoService
     */
    protected ReviewMessageVideoService $reviewMessageVideoService;

    /**
     * @var UserAvatarRepository
     */
    protected UserAvatarRepository $userAvatarRepository;

    /**
     * ReviewMessageController constructor
     */
    public function __construct()
    {
        /** @var ReviewMessageImageRepository reviewMessageImageRepository */
        $this->reviewMessageImageRepository = new ReviewMessageImageRepository();

        /** @var ReviewMessageImageService reviewMessageImageService */
        $this->reviewMessageImageService = new ReviewMessageImageService();

        /** @var ReviewMessageVideoRepository reviewMessageVideoRepository */
        $this->reviewMessageVideoRepository = new ReviewMessageVideoRepository();

        /** @var ReviewMessageVideoService reviewMessageVideoService */
        $this->reviewMessageVideoService = new ReviewMessageVideoService();

        /** @var UserAvatarRepository userAvatarRepository */
        $this->userAvatarRepository = new UserAvatarRepository();

        parent::__construct();
    }

    /**
     * @param GetForReviewMessagesRequest $request
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function getForReviewMessages(
        GetForReviewMessagesRequest $request
    ) : JsonResponse
    {
        /**
         * Getting review messages images
         */
        $reviewMessagesImages = $this->reviewMessageImageRepository->getForMessages(
            $request->input('review_messages_ids')
        );

        /**
         * Getting review messages videos
         */
        $reviewMessagesVideos = $this->reviewMessageVideoRepository->getForMessages(
            $request->input('review_messages_ids')
        );

        /**
         * Getting users avatars
         */
        $usersAvatars = $this->userAvatarRepository->getForUsers(
            $request->input('auth_ids')
        );

        return $this->respondWithSuccess(
            $this->transformItem([], new ReviewMessageTransformer(
                $reviewMessagesImages,
                $reviewMessagesVideos,
                $usersAvatars
            ))['review_message'],
            trans('validations/api/general/review/message/getForReviewMessages.result.success')
        );
    }

    /**
     * @param string $messageId
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteForReviewMessage(
        string $messageId
    ) : JsonResponse
    {
        /**
         * Getting review message images
         */
        $reviewMessageImages = $this->reviewMessageImageRepository->getForMessage(
            $messageId
        );

        /**
         * Deleting review message images
         */
        $this->reviewMessageImageService->deleteImages(
            $reviewMessageImages
        );

        /**
         * Getting review message videos
         */
        $reviewMessageVideos = $this->reviewMessageVideoRepository->getForMessage(
            $messageId
        );

        /**
         * Deleting review message videos
         */
        $this->reviewMessageVideoService->deleteVideos(
            $reviewMessageVideos
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/review/message/deleteForReviewMessage.result.success')
        );
    }
}
