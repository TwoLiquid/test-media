<?php

namespace App\Http\Controllers\Api\General\Chat;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\Chat\Interfaces\ChatMessageVideoControllerInterface;
use App\Http\Requests\Api\General\Chat\Message\Video\DestroyManyRequest;
use App\Http\Requests\Api\General\Chat\Message\Video\StoreManyRequest;
use App\Http\Requests\Api\General\Chat\Message\Video\StoreRequest;
use App\Repositories\Chat\ChatMessageVideoRepository;
use App\Services\Chat\ChatMessageVideoService;
use App\Transformers\Api\General\Chat\ChatMessageVideoTransformer;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class ChatMessageVideoController
 *
 * @package App\Http\Controllers\Api\General\Chat
 */
final class ChatMessageVideoController extends BaseController implements ChatMessageVideoControllerInterface
{
    /**
     * @var ChatMessageVideoRepository
     */
    protected ChatMessageVideoRepository $chatMessageVideoRepository;

    /**
     * @var ChatMessageVideoService
     */
    protected ChatMessageVideoService $chatMessageVideoService;

    /**
     * ChatMessageVideoController constructor
     */
    public function __construct()
    {
        /** @var ChatMessageVideoRepository chatMessageVideoRepository */
        $this->chatMessageVideoRepository = new ChatMessageVideoRepository();

        /** @var ChatMessageVideoService chatMessageVideoService */
        $this->chatMessageVideoService = new ChatMessageVideoService();

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
         * Getting chat message video
         */
        $chatMessageVideo = $this->chatMessageVideoRepository->findById($id);

        /**
         * Checking chat message video existence
         */
        if (!$chatMessageVideo) {
            throw new BaseException(
                trans('validations/api/general/chat/message/video/downloadFile.result.error'),
                null,
                400
            );
        }

        return $this->respondWithDownload(
            $chatMessageVideo->url
        );
    }

    /**
     * @param string $chatMessageId
     * @param StoreRequest $request
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function store(
        string $chatMessageId,
        StoreRequest $request
    ) : JsonResponse
    {
        /**
         * Creating chat message video
         */
        $chatMessageVideo = $this->chatMessageVideoService->createVideo(
            $chatMessageId,
            $request->input('content'),
            $request->input('mime'),
            $request->input('extension')
        );

        return $this->respondWithSuccess(
            $this->transformItem($chatMessageVideo, new ChatMessageVideoTransformer),
            trans('validations/api/general/chat/message/video/store.result.success')
        );
    }

    /**
     * @param string $chatMessageId
     * @param StoreManyRequest $request
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function storeMany(
        string $chatMessageId,
        StoreManyRequest $request
    ) : JsonResponse
    {
        /**
         * Creating chat message videos
         */
        $chatMessageVideos = $this->chatMessageVideoService->createVideos(
            $chatMessageId,
            $request->input('chat_message_videos')
        );

        return $this->respondWithSuccess(
            $this->transformCollection($chatMessageVideos, new ChatMessageVideoTransformer),
            trans('validations/api/general/chat/message/video/storeMany.result.success')
        );
    }

    /**
     * @param string $chatMessageId
     * @param DestroyManyRequest $request
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function destroyMany(
        string $chatMessageId,
        DestroyManyRequest $request
    ) : JsonResponse
    {
        /**
         * Getting chat message videos
         */
        $chatMessageVideos = $this->chatMessageVideoRepository->getForChatMessageByIds(
            $chatMessageId,
            $request->input('chat_message_videos_ids')
        );

        /**
         * Checking chat message videos
         */
        if ($chatMessageVideos->isEmpty()) {
            return $this->respondWithError(
                trans('validations/api/general/chat/message/video/destroyMany.result.error.find')
            );
        }

        /**
         * Deleting chat message videos
         */
        $this->chatMessageVideoService->deleteVideos(
            $chatMessageVideos
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/chat/message/video/destroyMany.result.success')
        );
    }
}
