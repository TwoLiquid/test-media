<?php

namespace App\Http\Controllers\Api\General\Support\Ticket;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\Support\Ticket\Interfaces\SupportTicketMessageAudioControllerInterface;
use App\Http\Requests\Api\General\Support\Ticket\Message\Audio\DestroyManyRequest;
use App\Http\Requests\Api\General\Support\Ticket\Message\Audio\StoreManyRequest;
use App\Http\Requests\Api\General\Support\Ticket\Message\Audio\StoreRequest;
use App\Repositories\Support\SupportTicketMessageAudioRepository;
use App\Services\Support\SupportTicketMessageAudioService;
use App\Transformers\Api\General\Support\SupportTicketMessageAudioTransformer;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class SupportTicketMessageAudioController
 *
 * @package App\Http\Controllers\Api\General\Support\Ticket
 */
final class SupportTicketMessageAudioController extends BaseController implements SupportTicketMessageAudioControllerInterface
{
    /**
     * @var SupportTicketMessageAudioRepository
     */
    protected SupportTicketMessageAudioRepository $supportTicketMessageAudioRepository;

    /**
     * @var SupportTicketMessageAudioService
     */
    protected SupportTicketMessageAudioService $supportTicketMessageAudioService;

    /**
     * SupportTicketMessageAudioController constructor
     */
    public function __construct()
    {
        /** @var SupportTicketMessageAudioRepository supportTicketMessageAudioRepository */
        $this->supportTicketMessageAudioRepository = new SupportTicketMessageAudioRepository();

        /** @var SupportTicketMessageAudioService supportTicketMessageAudioService */
        $this->supportTicketMessageAudioService = new SupportTicketMessageAudioService();

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
         * Getting a support ticket message audio
         */
        $supportTicketMessageAudio = $this->supportTicketMessageAudioRepository->findById($id);

        /**
         * Checking support ticket message audio existence
         */
        if (!$supportTicketMessageAudio) {
            throw new BaseException(
                trans('validations/api/general/support/ticket/message/audio/downloadFile.result.error'),
                null,
                400
            );
        }

        return $this->respondWithDownload(
            $supportTicketMessageAudio->url
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
         * Creating support ticket message audio
         */
        $supportTicketMessageAudio = $this->supportTicketMessageAudioService->createAudio(
            $messageId,
            $request->input('content'),
            $request->input('mime'),
            $request->input('extension')
        );

        return $this->respondWithSuccess(
            $this->transformItem($supportTicketMessageAudio, new SupportTicketMessageAudioTransformer),
            trans('validations/api/general/support/ticket/message/audio/store.result.success')
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
         * Creating support ticket message audios
         */
        $supportTicketMessageAudios = $this->supportTicketMessageAudioService->createAudios(
            $messageId,
            $request->input('support_ticket_message_audios')
        );

        return $this->respondWithSuccess(
            $this->transformCollection($supportTicketMessageAudios, new SupportTicketMessageAudioTransformer),
            trans('validations/api/general/support/ticket/message/audio/storeMany.result.success')
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
         * Getting support ticket message audios
         */
        $supportTicketMessageAudios = $this->supportTicketMessageAudioRepository->getForMessageByIds(
            $messageId,
            $request->input('support_ticket_message_audios_ids')
        );

        /**
         * Checking support ticket message audios
         */
        if ($supportTicketMessageAudios->isEmpty()) {
            return $this->respondWithError(
                trans('validations/api/general/support/ticket/message/audio/destroyMany.result.error.find')
            );
        }

        /**
         * Deleting support ticket message audios
         */
        $this->supportTicketMessageAudioService->deleteAudios(
            $supportTicketMessageAudios
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/support/ticket/message/audio/destroyMany.result.success')
        );
    }
}
