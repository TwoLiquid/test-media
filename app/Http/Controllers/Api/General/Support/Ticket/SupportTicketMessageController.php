<?php

namespace App\Http\Controllers\Api\General\Support\Ticket;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\Support\Ticket\Interfaces\SupportTicketMessageControllerInterface;
use App\Http\Requests\Api\General\Support\Ticket\Message\GetForSupportTicketMessagesRequest;
use App\Repositories\Support\SupportTicketMessageAudioRepository;
use App\Repositories\Support\SupportTicketMessageDocumentRepository;
use App\Repositories\Support\SupportTicketMessageImageRepository;
use App\Repositories\Support\SupportTicketMessageVideoRepository;
use App\Repositories\User\UserAvatarRepository;
use App\Services\Support\SupportTicketMessageAudioService;
use App\Services\Support\SupportTicketMessageDocumentService;
use App\Services\Support\SupportTicketMessageImageService;
use App\Services\Support\SupportTicketMessageVideoService;
use App\Transformers\Api\General\Support\SupportTicketMessageTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class SupportTicketMessageController
 *
 * @package App\Http\Controllers\Api\General\Support\Ticket
 */
final class SupportTicketMessageController extends BaseController implements SupportTicketMessageControllerInterface
{
    /**
     * @var SupportTicketMessageAudioService
     */
    protected SupportTicketMessageAudioService $supportTicketMessageAudioService;

    /**
     * @var SupportTicketMessageAudioRepository
     */
    protected SupportTicketMessageAudioRepository $supportTicketMessageAudioRepository;

    /**
     * @var SupportTicketMessageDocumentService
     */
    protected SupportTicketMessageDocumentService $supportTicketMessageDocumentService;

    /**
     * @var SupportTicketMessageDocumentRepository
     */
    protected SupportTicketMessageDocumentRepository $supportTicketMessageDocumentRepository;

    /**
     * @var SupportTicketMessageImageService
     */
    protected SupportTicketMessageImageService $supportTicketMessageImageService;

    /**
     * @var SupportTicketMessageImageRepository
     */
    protected SupportTicketMessageImageRepository $supportTicketMessageImageRepository;

    /**
     * @var SupportTicketMessageVideoService
     */
    protected SupportTicketMessageVideoService $supportTicketMessageVideoService;

    /**
     * @var SupportTicketMessageVideoRepository
     */
    protected SupportTicketMessageVideoRepository $supportTicketMessageVideoRepository;

    /**
     * @var UserAvatarRepository
     */
    protected UserAvatarRepository $userAvatarRepository;

    /**
     * SupportTicketMessageController constructor
     */
    public function __construct()
    {
        /** @var SupportTicketMessageAudioService supportTicketMessageAudioService */
        $this->supportTicketMessageAudioService = new SupportTicketMessageAudioService();

        /** @var SupportTicketMessageAudioRepository supportTicketMessageAudioRepository */
        $this->supportTicketMessageAudioRepository = new SupportTicketMessageAudioRepository();

        /** @var SupportTicketMessageDocumentService supportTicketMessageDocumentService */
        $this->supportTicketMessageDocumentService = new SupportTicketMessageDocumentService();

        /** @var SupportTicketMessageDocumentRepository supportTicketMessageDocumentRepository */
        $this->supportTicketMessageDocumentRepository = new SupportTicketMessageDocumentRepository();

        /** @var SupportTicketMessageImageService supportTicketMessageImageService */
        $this->supportTicketMessageImageService = new SupportTicketMessageImageService();

        /** @var SupportTicketMessageImageRepository supportTicketMessageImageRepository */
        $this->supportTicketMessageImageRepository = new SupportTicketMessageImageRepository();

        /** @var SupportTicketMessageVideoService supportTicketMessageVideoService */
        $this->supportTicketMessageVideoService = new SupportTicketMessageVideoService();

        /** @var SupportTicketMessageVideoRepository supportTicketMessageVideoRepository */
        $this->supportTicketMessageVideoRepository = new SupportTicketMessageVideoRepository();

        /** @var UserAvatarRepository userAvatarRepository */
        $this->userAvatarRepository = new UserAvatarRepository();

        parent::__construct();
    }

    /**
     * @param GetForSupportTicketMessagesRequest $request
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function getForSupportTicketMessages(
        GetForSupportTicketMessagesRequest $request
    ) : JsonResponse
    {
        /**
         * Getting support ticket messages audios
         */
        $supportTicketMessagesAudios = $this->supportTicketMessageAudioRepository->getForMessages(
            $request->input('support_ticket_messages_ids')
        );

        /**
         * Getting support ticket messages documents
         */
        $supportTicketMessagesDocuments = $this->supportTicketMessageDocumentRepository->getForMessages(
            $request->input('support_ticket_messages_ids')
        );

        /**
         * Getting support ticket messages images
         */
        $supportTicketMessagesImages = $this->supportTicketMessageImageRepository->getForMessages(
            $request->input('support_ticket_messages_ids')
        );

        /**
         * Getting support ticket messages videos
         */
        $supportTicketMessagesVideos = $this->supportTicketMessageVideoRepository->getForMessages(
            $request->input('support_ticket_messages_ids')
        );

        /**
         * Getting users avatars
         */
        $usersAvatars = $this->userAvatarRepository->getForUsers(
            $request->input('auth_ids')
        );

        return $this->respondWithSuccess(
            $this->transformItem([], new SupportTicketMessageTransformer(
                $supportTicketMessagesAudios,
                $supportTicketMessagesDocuments,
                $supportTicketMessagesImages,
                $supportTicketMessagesVideos,
                $usersAvatars
            ))['support_ticket_message'],
            trans('validations/api/general/support/ticket/message/getForSupportTicketMessages.result.success')
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
    public function deleteForSupportTicketMessage(
        string $messageId
    ) : JsonResponse
    {
        /**
         * Getting support ticket message audios
         */
        $supportTicketMessageAudios = $this->supportTicketMessageAudioRepository->getForMessage(
            $messageId
        );

        /**
         * Deleting support ticket message audios
         */
        $this->supportTicketMessageAudioService->deleteAudios(
            $supportTicketMessageAudios
        );

        /**
         * Getting support ticket message documents
         */
        $supportTicketMessageDocuments = $this->supportTicketMessageDocumentRepository->getForMessage(
            $messageId
        );

        /**
         * Deleting support ticket message documents
         */
        $this->supportTicketMessageDocumentService->deleteDocuments(
            $supportTicketMessageDocuments
        );

        /**
         * Getting support ticket message images
         */
        $supportTicketMessageImages = $this->supportTicketMessageImageRepository->getForMessage(
            $messageId
        );

        /**
         * Deleting support ticket message images
         */
        $this->supportTicketMessageImageService->deleteImages(
            $supportTicketMessageImages
        );

        /**
         * Getting support ticket message videos
         */
        $supportTicketMessageVideos = $this->supportTicketMessageVideoRepository->getForMessage(
            $messageId
        );

        /**
         * Deleting support ticket message videos
         */
        $this->supportTicketMessageVideoService->deleteVideos(
            $supportTicketMessageVideos
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/support/ticket/message/deleteForSupportTicketMessage.result.success')
        );
    }
}
