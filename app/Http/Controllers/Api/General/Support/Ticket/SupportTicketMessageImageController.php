<?php

namespace App\Http\Controllers\Api\General\Support\Ticket;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\Support\Ticket\Interfaces\SupportTicketMessageImageControllerInterface;
use App\Http\Requests\Api\General\Support\Ticket\Message\Image\DestroyManyRequest;
use App\Http\Requests\Api\General\Support\Ticket\Message\Image\StoreManyRequest;
use App\Http\Requests\Api\General\Support\Ticket\Message\Image\StoreRequest;
use App\Repositories\Support\SupportTicketMessageImageRepository;
use App\Services\Support\SupportTicketMessageImageService;
use App\Transformers\Api\General\Support\SupportTicketMessageImageTransformer;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class SupportTicketMessageImageController
 *
 * @package App\Http\Controllers\Api\General\Support\Ticket
 */
final class SupportTicketMessageImageController extends BaseController implements SupportTicketMessageImageControllerInterface
{
    /**
     * @var SupportTicketMessageImageRepository
     */
    protected SupportTicketMessageImageRepository $supportTicketMessageImageRepository;

    /**
     * @var SupportTicketMessageImageService
     */
    protected SupportTicketMessageImageService $supportTicketMessageImageService;

    /**
     * SupportTicketMessageImageController constructor
     */
    public function __construct()
    {
        /** @var SupportTicketMessageImageRepository supportTicketMessageImageRepository */
        $this->supportTicketMessageImageRepository = new SupportTicketMessageImageRepository();

        /** @var SupportTicketMessageImageService supportTicketMessageImageService */
        $this->supportTicketMessageImageService = new SupportTicketMessageImageService();

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
         * Getting support ticket message image
         */
        $supportTicketMessageImage = $this->supportTicketMessageImageRepository->findById($id);

        /**
         * Checking support ticket message image existence
         */
        if (!$supportTicketMessageImage) {
            throw new BaseException(
                trans('validations/api/general/support/ticket/message/image/downloadFile.result.error'),
                null,
                400
            );
        }

        return $this->respondWithDownload(
            $supportTicketMessageImage->url
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
         * Getting support ticket message image
         */
        $supportTicketMessageImage = $this->supportTicketMessageImageRepository->findById($id);

        /**
         * Checking support ticket message image existence
         */
        if (!$supportTicketMessageImage) {
            throw new BaseException(
                trans('validations/api/general/support/ticket/message/image/downloadMinFile.result.error'),
                null,
                400
            );
        }

        return $this->respondWithDownload(
            getMinimizedFilePath($supportTicketMessageImage->url)
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
         * Creating support ticket message image
         */
        $supportTicketMessageImage = $this->supportTicketMessageImageService->createImage(
            $messageId,
            $request->input('content'),
            $request->input('mime'),
            $request->input('extension')
        );

        return $this->respondWithSuccess(
            $this->transformItem($supportTicketMessageImage, new SupportTicketMessageImageTransformer),
            trans('validations/api/general/support/ticket/message/image/store.result.success')
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
         * Creating support ticket message images
         */
        $supportTicketMessageImages = $this->supportTicketMessageImageService->createImages(
            $messageId,
            $request->input('support_ticket_message_images')
        );

        return $this->respondWithSuccess(
            $this->transformCollection($supportTicketMessageImages, new SupportTicketMessageImageTransformer),
            trans('validations/api/general/support/ticket/message/image/storeMany.result.success')
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
         * Getting support ticket message images
         */
        $supportTicketMessageImages = $this->supportTicketMessageImageRepository->getByIds(
            $request->input('support_ticket_message_images_ids')
        );

        /**
         * Checking support ticket message images
         */
        if ($supportTicketMessageImages->isEmpty()) {
            return $this->respondWithError(
                trans('validations/api/general/support/ticket/message/image/destroyMany.result.error.find')
            );
        }

        /**
         * Deleting support ticket message images
         */
        $this->supportTicketMessageImageService->deleteImages(
            $supportTicketMessageImages
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/support/ticket/message/image/destroyMany.result.success')
        );
    }
}
