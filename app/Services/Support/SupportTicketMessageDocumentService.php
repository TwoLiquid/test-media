<?php

namespace App\Services\Support;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\Support\SupportTicketMessageDocument;
use App\Repositories\Support\SupportTicketMessageDocumentRepository;
use App\Services\File\FileService;
use App\Services\Support\Interfaces\SupportTicketMessageDocumentServiceInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class SupportTicketMessageDocumentService
 *
 * @package App\Services\Support
 */
final class SupportTicketMessageDocumentService extends FileService implements SupportTicketMessageDocumentServiceInterface
{
    /**
     * Storage disk environment
     */
    protected const ENVIRONMENT = 'private';

    /**
     * Document files storage name
     */
    protected const FOLDER = 'support_ticket_message_documents';

    /**
     * @var SupportTicketMessageDocumentRepository
     */
    protected SupportTicketMessageDocumentRepository $supportTicketMessageDocumentRepository;

    /**
     * SupportTicketMessageDocumentService constructor
     */
    public function __construct()
    {
        /** @var SupportTicketMessageDocumentRepository supportTicketMessageDocumentRepository */
        $this->supportTicketMessageDocumentRepository = new SupportTicketMessageDocumentRepository();
    }

    /**
     * @param string $messageId
     * @param string $content
     * @param string $originalName
     * @param string $mime
     * @param string $extension
     *
     * @return SupportTicketMessageDocument
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createDocument(
        string $messageId,
        string $content,
        string $originalName,
        string $mime,
        string $extension
    ) : SupportTicketMessageDocument
    {
        /**
         * Uploading file
         */
        $filePath = $this->uploadFile(
            $content,
            $extension,
            self::FOLDER
        );

        /**
         * Getting file size
         */
        $size = $this->getFileSize(
            $filePath
        );

        /**
         * Creating a support ticket message document
         */
        return $this->supportTicketMessageDocumentRepository->store(
            $messageId,
            $filePath,
            $originalName,
            $size,
            $mime
        );
    }

    /**
     * @param string $messageId
     * @param array $documentFiles
     *
     * @return Collection
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createDocuments(
        string $messageId,
        array $documentFiles
    ) : Collection
    {
        /**
         * Preparing a support ticket message documents collection
         */
        $supportTicketMessageDocuments = new Collection();

        /** @var array $documentFile */
        foreach ($documentFiles as $documentFile) {

            /**
             * Pushing created a support ticket message document to response
             */
            $supportTicketMessageDocuments->push(
                $this->createDocument(
                    $messageId,
                    $documentFile['content'],
                    $documentFile['original_name'],
                    $documentFile['mime'],
                    $documentFile['extension']
                )
            );
        }

        return $supportTicketMessageDocuments;
    }

    /**
     * @param SupportTicketMessageDocument $supportTicketMessageDocument
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteDocument(
        SupportTicketMessageDocument $supportTicketMessageDocument
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $supportTicketMessageDocument->url
        );

        /**
         * Deleting a support ticket message document
         */
        return $this->supportTicketMessageDocumentRepository->delete(
            $supportTicketMessageDocument
        );
    }

    /**
     * @param Collection $supportTicketMessageDocuments
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteDocuments(
        Collection $supportTicketMessageDocuments
    ) : bool
    {
        /** @var SupportTicketMessageDocument $supportTicketMessageDocument */
        foreach ($supportTicketMessageDocuments as $supportTicketMessageDocument) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $supportTicketMessageDocument->url
            );
        }

        /**
         * Deleting a support ticket message documents
         */
        return $this->supportTicketMessageDocumentRepository->deleteByIds(
            $supportTicketMessageDocuments->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
