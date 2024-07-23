<?php

namespace App\Http\Controllers\Api\General\Support\Ticket;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\Support\Ticket\Interfaces\SupportTicketMessageDocumentControllerInterface;
use App\Http\Requests\Api\General\Support\Ticket\Message\Document\DestroyManyRequest;
use App\Http\Requests\Api\General\Support\Ticket\Message\Document\StoreManyRequest;
use App\Http\Requests\Api\General\Support\Ticket\Message\Document\StoreRequest;
use App\Repositories\Support\SupportTicketMessageDocumentRepository;
use App\Services\Support\SupportTicketMessageDocumentService;
use App\Transformers\Api\General\Support\SupportTicketMessageDocumentTransformer;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class SupportTicketMessageDocumentController
 *
 * @package App\Http\Controllers\Api\General\Support\Ticket
 */
final class SupportTicketMessageDocumentController extends BaseController implements SupportTicketMessageDocumentControllerInterface
{
    /**
     * @var SupportTicketMessageDocumentRepository
     */
    protected SupportTicketMessageDocumentRepository $supportTicketMessageDocumentRepository;

    /**
     * @var SupportTicketMessageDocumentService
     */
    protected SupportTicketMessageDocumentService $supportTicketMessageDocumentService;

    /**
     * SupportTicketMessageDocumentController constructor
     */
    public function __construct()
    {
        /** @var SupportTicketMessageDocumentRepository supportTicketMessageDocumentRepository */
        $this->supportTicketMessageDocumentRepository = new SupportTicketMessageDocumentRepository();

        /** @var SupportTicketMessageDocumentService supportTicketMessageDocumentService */
        $this->supportTicketMessageDocumentService = new SupportTicketMessageDocumentService();

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
         * Getting a support ticket message document
         */
        $supportTicketMessageDocument = $this->supportTicketMessageDocumentRepository->findById($id);

        /**
         * Checking a support ticket message document existence
         */
        if (!$supportTicketMessageDocument) {
            throw new BaseException(
                trans('validations/api/general/support/ticket/message/document/downloadFile.result.error'),
                null,
                400
            );
        }

        return $this->respondWithDownload(
            $supportTicketMessageDocument->url
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
         * Creating a support ticket message document
         */
        $supportTicketMessageDocument = $this->supportTicketMessageDocumentService->createDocument(
            $messageId,
            $request->input('content'),
            $request->input('original_name'),
            $request->input('mime'),
            $request->input('extension')
        );

        return $this->respondWithSuccess(
            $this->transformItem($supportTicketMessageDocument, new SupportTicketMessageDocumentTransformer),
            trans('validations/api/general/support/ticket/message/document/store.result.success')
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
         * Creating a support ticket message documents
         */
        $supportTicketMessageDocuments = $this->supportTicketMessageDocumentService->createDocuments(
            $messageId,
            $request->input('support_ticket_message_documents')
        );

        return $this->respondWithSuccess(
            $this->transformCollection($supportTicketMessageDocuments, new SupportTicketMessageDocumentTransformer),
            trans('validations/api/general/support/ticket/message/document/storeMany.result.success')
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
         * Getting a support ticket message documents
         */
        $supportTicketMessageDocuments = $this->supportTicketMessageDocumentRepository->getForMessageByIds(
            $messageId,
            $request->input('support_ticket_message_documents_ids')
        );

        /**
         * Checking support ticket message documents
         */
        if ($supportTicketMessageDocuments->isEmpty()) {
            return $this->respondWithError(
                trans('validations/api/general/support/ticket/message/document/destroyMany.result.error.find')
            );
        }

        /**
         * Deleting a support ticket message documents
         */
        $this->supportTicketMessageDocumentService->deleteDocuments(
            $supportTicketMessageDocuments
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/support/ticket/message/document/destroyMany.result.success')
        );
    }
}
