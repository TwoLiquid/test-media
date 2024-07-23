<?php

namespace App\Http\Controllers\Api\General\Chat;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\Chat\Interfaces\ChatMessageImageControllerInterface;
use App\Http\Requests\Api\General\Chat\Message\Image\DestroyManyRequest;
use App\Http\Requests\Api\General\Chat\Message\Image\StoreManyRequest;
use App\Http\Requests\Api\General\Chat\Message\Image\StoreRequest;
use App\Repositories\Chat\ChatMessageImageRepository;
use App\Services\Chat\ChatMessageImageService;
use App\Transformers\Api\General\Chat\ChatMessageImageTransformer;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class ChatMessageImageController
 *
 * @package App\Http\Controllers\Api\General\Chat
 */
final class ChatMessageImageController extends BaseController implements ChatMessageImageControllerInterface
{
    /**
     * @var ChatMessageImageRepository
     */
    protected ChatMessageImageRepository $chatMessageImageRepository;

    /**
     * @var ChatMessageImageService
     */
    protected ChatMessageImageService $chatMessageImageService;

    /**
     * ChatMessageImageController constructor
     */
    public function __construct()
    {
        /** @var ChatMessageImageRepository chatMessageImageRepository */
        $this->chatMessageImageRepository = new ChatMessageImageRepository();

        /** @var ChatMessageImageService chatMessageImageService */
        $this->chatMessageImageService = new ChatMessageImageService();

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
         * Getting chat message image
         */
        $chatMessageImage = $this->chatMessageImageRepository->findById($id);

        /**
         * Checking chat message image existence
         */
        if (!$chatMessageImage) {
            throw new BaseException(
                trans('validations/api/general/chat/message/image/downloadFile.result.error'),
                null,
                400
            );
        }

        return $this->respondWithDownload(
            $chatMessageImage->url
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
         * Getting chat message image
         */
        $chatMessageImage = $this->chatMessageImageRepository->findById($id);

        /**
         * Checking chat message image existence
         */
        if (!$chatMessageImage) {
            throw new BaseException(
                trans('validations/api/general/chat/message/image/downloadMinFile.result.error'),
                null,
                400
            );
        }

        return $this->respondWithDownload(
            getMinimizedFilePath($chatMessageImage->url)
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
         * Creating chat message image
         */
        $chatMessageImage = $this->chatMessageImageService->createImage(
            $chatMessageId,
            $request->input('content'),
            $request->input('mime'),
            $request->input('extension')
        );

        return $this->respondWithSuccess(
            $this->transformItem($chatMessageImage, new ChatMessageImageTransformer),
            trans('validations/api/general/chat/message/image/store.result.success')
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
         * Creating chat message images
         */
        $chatMessageImages = $this->chatMessageImageService->createImages(
            $chatMessageId,
            $request->input('chat_message_images')
        );

        return $this->respondWithSuccess(
            $this->transformCollection($chatMessageImages, new ChatMessageImageTransformer),
            trans('validations/api/general/chat/message/image/storeMany.result.success')
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
         * Getting chat message images
         */
        $chatMessageImages = $this->chatMessageImageRepository->getForChatMessageByIds(
            $chatMessageId,
            $request->input('chat_message_images_ids')
        );

        /**
         * Checking chat message images
         */
        if ($chatMessageImages->isEmpty()) {
            return $this->respondWithError(
                trans('validations/api/general/chat/message/image/destroyMany.result.error.find')
            );
        }

        /**
         * Deleting chat message images
         */
        $this->chatMessageImageService->deleteImages(
            $chatMessageImages
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/chat/message/image/destroyMany.result.success')
        );
    }
}
