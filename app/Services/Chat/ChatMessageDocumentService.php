<?php

namespace App\Services\Chat;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\Chat\ChatMessageDocument;
use App\Repositories\Chat\ChatMessageDocumentRepository;
use App\Services\Chat\Interfaces\ChatMessageDocumentServiceInterface;
use App\Services\File\FileService;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ChatMessageDocumentService
 *
 * @package App\Services\Chat
 */
final class ChatMessageDocumentService extends FileService implements ChatMessageDocumentServiceInterface
{
    /**
     * Storage disk environment
     */
    protected const ENVIRONMENT = 'private';

    /**
     * Document files storage name
     */
    protected const FOLDER = 'chat_message_documents';

    /**
     * @var ChatMessageDocumentRepository
     */
    protected ChatMessageDocumentRepository $chatMessageDocumentRepository;

    /**
     * ChatMessageDocumentService constructor
     */
    public function __construct()
    {
        /** @var ChatMessageDocumentRepository chatMessageDocumentRepository */
        $this->chatMessageDocumentRepository = new ChatMessageDocumentRepository();
    }

    /**
     * @param string $chatMessageId
     * @param string $content
     * @param string $originalName
     * @param string $mime
     * @param string $extension
     *
     * @return ChatMessageDocument
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createDocument(
        string $chatMessageId,
        string $content,
        string $originalName,
        string $mime,
        string $extension
    ) : ChatMessageDocument
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
         * Creating a chat message document
         */
        return $this->chatMessageDocumentRepository->store(
            $chatMessageId,
            $filePath,
            $originalName,
            $size,
            $mime
        );
    }

    /**
     * @param string $chatMessageId
     * @param array $chatMessageDocumentFiles
     *
     * @return Collection
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createDocuments(
        string $chatMessageId,
        array $chatMessageDocumentFiles
    ) : Collection
    {
        /**
         * Preparing a chat message documents collection
         */
        $chatMessageDocuments = new Collection();

        /** @var array $chatMessageDocumentFile */
        foreach ($chatMessageDocumentFiles as $chatMessageDocumentFile) {

            /**
             * Pushing created a chat message document to response
             */
            $chatMessageDocuments->push(
                $this->createDocument(
                    $chatMessageId,
                    $chatMessageDocumentFile['content'],
                    $chatMessageDocumentFile['original_name'],
                    $chatMessageDocumentFile['mime'],
                    $chatMessageDocumentFile['extension']
                )
            );
        }

        return $chatMessageDocuments;
    }

    /**
     * @param ChatMessageDocument $chatMessageDocument
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteDocument(
        ChatMessageDocument $chatMessageDocument
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $chatMessageDocument->url
        );

        /**
         * Deleting a chat message document
         */
        return $this->chatMessageDocumentRepository->delete(
            $chatMessageDocument
        );
    }

    /**
     * @param Collection $chatMessageDocuments
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteDocuments(
        Collection $chatMessageDocuments
    ) : bool
    {
        /** @var ChatMessageDocument $chatMessageDocument */
        foreach ($chatMessageDocuments as $chatMessageDocument) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $chatMessageDocument->url
            );
        }

        /**
         * Deleting a chat message documents
         */
        return $this->chatMessageDocumentRepository->deleteByIds(
            $chatMessageDocuments->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
