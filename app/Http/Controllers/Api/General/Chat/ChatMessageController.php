<?php

namespace App\Http\Controllers\Api\General\Chat;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\Chat\Interfaces\ChatMessageControllerInterface;
use App\Http\Requests\Api\General\Chat\Message\GetForChatMessagesRequest;
use App\Repositories\Chat\ChatMessageAudioRepository;
use App\Repositories\Chat\ChatMessageDocumentRepository;
use App\Repositories\Chat\ChatMessageImageRepository;
use App\Repositories\Chat\ChatMessageVideoRepository;
use App\Repositories\User\UserAvatarRepository;
use App\Services\Chat\ChatMessageAudioService;
use App\Services\Chat\ChatMessageDocumentService;
use App\Services\Chat\ChatMessageImageService;
use App\Services\Chat\ChatMessageVideoService;
use App\Transformers\Api\General\Chat\ChatMessageTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class ChatMessageController
 *
 * @package App\Http\Controllers\Api\General\Chat
 */
final class ChatMessageController extends BaseController implements ChatMessageControllerInterface
{
    /**
     * @var ChatMessageAudioService
     */
    protected ChatMessageAudioService $chatMessageAudioService;

    /**
     * @var ChatMessageAudioRepository
     */
    protected ChatMessageAudioRepository $chatMessageAudioRepository;

    /**
     * @var ChatMessageDocumentService
     */
    protected ChatMessageDocumentService $chatMessageDocumentService;

    /**
     * @var ChatMessageDocumentRepository
     */
    protected ChatMessageDocumentRepository $chatMessageDocumentRepository;

    /**
     * @var ChatMessageImageService
     */
    protected ChatMessageImageService $chatMessageImageService;

    /**
     * @var ChatMessageImageRepository
     */
    protected ChatMessageImageRepository $chatMessageImageRepository;

    /**
     * @var ChatMessageVideoService
     */
    protected ChatMessageVideoService $chatMessageVideoService;

    /**
     * @var ChatMessageVideoRepository
     */
    protected ChatMessageVideoRepository $chatMessageVideoRepository;

    /**
     * @var UserAvatarRepository
     */
    protected UserAvatarRepository $userAvatarRepository;

    /**
     * ChatMessageController constructor
     */
    public function __construct()
    {
        /** @var ChatMessageAudioService chatMessageAudioService */
        $this->chatMessageAudioService = new ChatMessageAudioService();

        /** @var ChatMessageAudioRepository chatMessageAudioRepository */
        $this->chatMessageAudioRepository = new ChatMessageAudioRepository();

        /** @var ChatMessageDocumentService chatMessageDocumentService */
        $this->chatMessageDocumentService = new ChatMessageDocumentService();

        /** @var ChatMessageDocumentRepository chatMessageDocumentRepository */
        $this->chatMessageDocumentRepository = new ChatMessageDocumentRepository();

        /** @var ChatMessageImageService chatMessageImageService */
        $this->chatMessageImageService = new ChatMessageImageService();

        /** @var ChatMessageImageRepository chatMessageImageRepository */
        $this->chatMessageImageRepository = new ChatMessageImageRepository();

        /** @var ChatMessageVideoService chatMessageVideoService */
        $this->chatMessageVideoService = new ChatMessageVideoService();

        /** @var ChatMessageVideoRepository chatMessageVideoRepository */
        $this->chatMessageVideoRepository = new ChatMessageVideoRepository();

        /** @var UserAvatarRepository userAvatarRepository */
        $this->userAvatarRepository = new UserAvatarRepository();

        parent::__construct();
    }

    /**
     * @param GetForChatMessagesRequest $request
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function getForChatMessages(
        GetForChatMessagesRequest $request
    ) : JsonResponse
    {
        /**
         * Getting chat messages audios
         */
        $chatMessagesAudios = $this->chatMessageAudioRepository->getForChatMessages(
            $request->input('chat_messages_ids')
        );

        /**
         * Getting chat messages documents
         */
        $chatMessagesDocuments = $this->chatMessageDocumentRepository->getForChatMessages(
            $request->input('chat_messages_ids')
        );

        /**
         * Getting chat messages images
         */
        $chatMessagesImages = $this->chatMessageImageRepository->getForChatMessages(
            $request->input('chat_messages_ids')
        );

        /**
         * Getting chat messages videos
         */
        $chatMessagesVideos = $this->chatMessageVideoRepository->getForChatMessages(
            $request->input('chat_messages_ids')
        );

        /**
         * Getting users avatars
         */
        $usersAvatars = $this->userAvatarRepository->getForUsers(
            $request->input('auth_ids')
        );

        return $this->respondWithSuccess(
            $this->transformItem([], new ChatMessageTransformer(
                $chatMessagesAudios,
                $chatMessagesDocuments,
                $chatMessagesImages,
                $chatMessagesVideos,
                $usersAvatars
            ))['chat_message'],
            trans('validations/api/general/chat/message/getForChatMessages.result.success')
        );
    }

    /**
     * @param string $chatMessageId
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteForChatMessage(
        string $chatMessageId
    ) : JsonResponse
    {
        /**
         * Getting chat message audios
         */
        $chatMessageAudios = $this->chatMessageAudioRepository->getForChatMessage(
            $chatMessageId
        );

        /**
         * Deleting chat message audios
         */
        $this->chatMessageAudioService->deleteAudios(
            $chatMessageAudios
        );

        /**
         * Getting a chat message documents
         */
        $chatMessageDocuments = $this->chatMessageDocumentRepository->getForChatMessage(
            $chatMessageId
        );

        /**
         * Deleting a chat message documents
         */
        $this->chatMessageDocumentService->deleteDocuments(
            $chatMessageDocuments
        );

        /**
         * Getting chat message images
         */
        $chatMessageImages = $this->chatMessageImageRepository->getForChatMessage(
            $chatMessageId
        );

        /**
         * Deleting chat message images
         */
        $this->chatMessageImageService->deleteImages(
            $chatMessageImages
        );

        /**
         * Getting chat message videos
         */
        $chatMessageVideos = $this->chatMessageVideoRepository->getForChatMessage(
            $chatMessageId
        );

        /**
         * Deleting chat message videos
         */
        $this->chatMessageVideoService->deleteVideos(
            $chatMessageVideos
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/chat/message/deleteForChatMessage.result.success')
        );
    }
}
