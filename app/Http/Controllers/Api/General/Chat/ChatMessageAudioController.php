<?php

namespace App\Http\Controllers\Api\General\Chat;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\Chat\Interfaces\ChatMessageAudioControllerInterface;
use App\Http\Requests\Api\General\Chat\Message\Audio\DestroyManyRequest;
use App\Http\Requests\Api\General\Chat\Message\Audio\StoreManyRequest;
use App\Http\Requests\Api\General\Chat\Message\Audio\StoreRequest;
use App\Repositories\Chat\ChatMessageAudioRepository;
use App\Services\Chat\ChatMessageAudioService;
use App\Transformers\Api\General\Chat\ChatMessageAudioTransformer;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class ChatMessageAudioController
 *
 * @package App\Http\Controllers\Api\General\Chat
 */
final class ChatMessageAudioController extends BaseController implements ChatMessageAudioControllerInterface
{
    /**
     * @var ChatMessageAudioRepository
     */
    protected ChatMessageAudioRepository $chatMessageAudioRepository;

    /**
     * @var ChatMessageAudioService
     */
    protected ChatMessageAudioService $chatMessageAudioService;

    /**
     * ChatMessageAudioController constructor
     */
    public function __construct()
    {
        /** @var ChatMessageAudioRepository chatMessageAudioRepository */
        $this->chatMessageAudioRepository = new ChatMessageAudioRepository();

        /** @var ChatMessageAudioService chatMessageAudioService */
        $this->chatMessageAudioService = new ChatMessageAudioService();

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
         * Getting chat message audio
         */
        $chatMessageAudio = $this->chatMessageAudioRepository->findById($id);

        /**
         * Checking chat message audio existence
         */
        if (!$chatMessageAudio) {
            throw new BaseException(
                trans('validations/api/general/chat/message/audio/downloadFile.result.error'),
                null,
                400
            );
        }

        return $this->respondWithDownload(
            $chatMessageAudio->url
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
         * Creating chat message audio
         */
        $chatMessageAudio = $this->chatMessageAudioService->createAudio(
            $chatMessageId,
            $request->input('content'),
            $request->input('mime'),
            $request->input('extension')
        );

        return $this->respondWithSuccess(
            $this->transformItem($chatMessageAudio, new ChatMessageAudioTransformer),
            trans('validations/api/general/chat/message/audio/store.result.success')
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
         * Creating chat message audios
         */
        $chatMessageAudios = $this->chatMessageAudioService->createAudios(
            $chatMessageId,
            $request->input('chat_message_audios')
        );

        return $this->respondWithSuccess(
            $this->transformCollection($chatMessageAudios, new ChatMessageAudioTransformer),
            trans('validations/api/general/chat/message/audio/storeMany.result.success')
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
         * Getting chat message audios
         */
        $chatMessageAudios = $this->chatMessageAudioRepository->getForChatMessageByIds(
            $chatMessageId,
            $request->input('chat_message_audios_ids')
        );

        /**
         * Checking chat message audios
         */
        if ($chatMessageAudios->isEmpty()) {
            return $this->respondWithError(
                trans('validations/api/general/chat/message/audio/destroyMany.result.error.find')
            );
        }

        /**
         * Deleting chat message audios
         */
        $this->chatMessageAudioService->deleteAudios(
            $chatMessageAudios
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/chat/message/audio/destroyMany.result.success')
        );
    }
}
