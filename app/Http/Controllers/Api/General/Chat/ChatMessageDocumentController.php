<?php

namespace App\Http\Controllers\Api\General\Chat;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\Chat\Interfaces\ChatMessageDocumentControllerInterface;
use App\Http\Requests\Api\General\Chat\Message\Document\DestroyManyRequest;
use App\Http\Requests\Api\General\Chat\Message\Document\StoreManyRequest;
use App\Http\Requests\Api\General\Chat\Message\Document\StoreRequest;
use App\Repositories\Chat\ChatMessageDocumentRepository;
use App\Services\Chat\ChatMessageDocumentService;
use App\Transformers\Api\General\Chat\ChatMessageDocumentTransformer;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class ChatMessageDocumentController
 *
 * @package App\Http\Controllers\Api\General\Chat
 */
final class ChatMessageDocumentController extends BaseController implements ChatMessageDocumentControllerInterface
{
    /**
     * @var ChatMessageDocumentRepository
     */
    protected ChatMessageDocumentRepository $chatMessageDocumentRepository;

    /**
     * @var ChatMessageDocumentService
     */
    protected ChatMessageDocumentService $chatMessageDocumentService;

    /**
     * ChatMessageDocumentController constructor
     */
    public function __construct()
    {
        /** @var ChatMessageDocumentRepository chatMessageDocumentRepository */
        $this->chatMessageDocumentRepository = new ChatMessageDocumentRepository();

        /** @var ChatMessageDocumentService chatMessageDocumentService */
        $this->chatMessageDocumentService = new ChatMessageDocumentService();

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
         * Getting a chat message document
         */
        $chatMessageDocument = $this->chatMessageDocumentRepository->findById($id);

        /**
         * Checking a chat message document existence
         */
        if (!$chatMessageDocument) {
            throw new BaseException(
                trans('validations/api/general/chat/message/document/downloadFile.result.error'),
                null,
                400
            );
        }

        return $this->respondWithDownload(
            $chatMessageDocument->url
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
         * Creating a chat message document
         */
        $chatMessageDocument = $this->chatMessageDocumentService->createDocument(
            $chatMessageId,
            $request->input('content'),
            $request->input('original_name'),
            $request->input('mime'),
            $request->input('extension')
        );

        return $this->respondWithSuccess(
            $this->transformItem($chatMessageDocument, new ChatMessageDocumentTransformer),
            trans('validations/api/general/chat/message/document/store.result.success')
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
         * Creating a chat message documents
         */
        $chatMessageDocuments = $this->chatMessageDocumentService->createDocuments(
            $chatMessageId,
            $request->input('chat_message_documents')
        );

        return $this->respondWithSuccess(
            $this->transformCollection($chatMessageDocuments, new ChatMessageDocumentTransformer),
            trans('validations/api/general/chat/message/document/storeMany.result.success')
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
         * Getting a chat message documents
         */
        $chatMessageDocuments = $this->chatMessageDocumentRepository->getForChatMessageByIds(
            $chatMessageId,
            $request->input('chat_message_documents_ids')
        );

        /**
         * Checking chat message documents
         */
        if ($chatMessageDocuments->isEmpty()) {
            return $this->respondWithError(
                trans('validations/api/general/chat/message/document/destroyMany.result.error.find')
            );
        }

        /**
         * Deleting a chat message documents
         */
        $this->chatMessageDocumentService->deleteDocuments(
            $chatMessageDocuments
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/chat/message/document/destroyMany.result.success')
        );
    }
}
