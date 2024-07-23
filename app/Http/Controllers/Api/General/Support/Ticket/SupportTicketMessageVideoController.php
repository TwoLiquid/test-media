<?php

namespace App\Http\Controllers\Api\General\Support\Ticket;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\Support\Ticket\Interfaces\SupportTicketMessageVideoControllerInterface;
use App\Http\Requests\Api\General\Support\Ticket\Message\Video\DestroyManyRequest;
use App\Http\Requests\Api\General\Support\Ticket\Message\Video\StoreManyRequest;
use App\Http\Requests\Api\General\Support\Ticket\Message\Video\StoreRequest;
use App\Repositories\Support\SupportTicketMessageVideoRepository;
use App\Services\Support\SupportTicketMessageVideoService;
use App\Transformers\Api\General\Support\SupportTicketMessageVideoTransformer;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class SupportTicketMessageVideoController
 *
 * @package App\Http\Controllers\Api\General\Support\Ticket
 */
final class SupportTicketMessageVideoController extends BaseController implements SupportTicketMessageVideoControllerInterface
{
    /**
     * @var SupportTicketMessageVideoRepository
     */
    protected SupportTicketMessageVideoRepository $supportTicketMessageVideoRepository;

    /**
     * @var SupportTicketMessageVideoService
     */
    protected SupportTicketMessageVideoService $supportTicketMessageVideoService;

    /**
     * SupportTicketMessageVideoController constructor
     */
    public function __construct()
    {
        /** @var SupportTicketMessageVideoRepository supportTicketMessageVideoRepository */
        $this->supportTicketMessageVideoRepository = new SupportTicketMessageVideoRepository();

        /** @var SupportTicketMessageVideoService supportTicketMessageVideoService */
        $this->supportTicketMessageVideoService = new SupportTicketMessageVideoService();

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
         * Getting support ticket message video
         */
        $supportTicketMessageVideo = $this->supportTicketMessageVideoRepository->findById($id);

        /**
         * Checking support ticket message video existence
         */
        if (!$supportTicketMessageVideo) {
            throw new BaseException(
                trans('validations/api/general/support/ticket/message/video/downloadFile.result.error'),
                null,
                400
            );
        }

        return $this->respondWithDownload(
            $supportTicketMessageVideo->url
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
         * Creating support ticket message video
         */
        $supportTicketMessageVideo = $this->supportTicketMessageVideoService->createVideo(
            $messageId,
            $request->input('content'),
            $request->input('mime'),
            $request->input('extension')
        );

        return $this->respondWithSuccess(
            $this->transformItem($supportTicketMessageVideo, new SupportTicketMessageVideoTransformer),
            trans('validations/api/general/support/ticket/message/video/store.result.success')
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
         * Creating support ticket message videos
         */
        $supportTicketMessageVideos = $this->supportTicketMessageVideoService->createVideos(
            $messageId,
            $request->input('support_ticket_message_videos')
        );

        return $this->respondWithSuccess(
            $this->transformCollection($supportTicketMessageVideos, new SupportTicketMessageVideoTransformer),
            trans('validations/api/general/support/ticket/message/video/storeMany.result.success')
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
         * Getting support ticket message videos
         */
        $supportTicketMessageVideos = $this->supportTicketMessageVideoRepository->getForMessageByIds(
            $messageId,
            $request->input('support_ticket_message_videos_ids')
        );

        /**
         * Checking support ticket message videos
         */
        if ($supportTicketMessageVideos->isEmpty()) {
            return $this->respondWithError(
                trans('validations/api/general/support/ticket/message/video/destroyMany.result.error.find')
            );
        }

        /**
         * Deleting support ticket message videos
         */
        $this->supportTicketMessageVideoService->deleteVideos(
            $supportTicketMessageVideos
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/support/ticket/message/video/destroyMany.result.success')
        );
    }
}
