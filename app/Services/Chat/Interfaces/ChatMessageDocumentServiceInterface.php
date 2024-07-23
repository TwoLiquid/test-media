<?php

namespace App\Services\Chat\Interfaces;

use App\Models\MySql\Chat\ChatMessageDocument;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface ChatMessageDocumentServiceInterface
 *
 * @package App\Services\Chat\Interfaces
 */
interface ChatMessageDocumentServiceInterface
{
    /**
     * This method provides creating data
     *
     * @param string $chatMessageId
     * @param string $content
     * @param string $originalName
     * @param string $mime
     * @param string $extension
     *
     * @return ChatMessageDocument
     */
    public function createDocument(
        string $chatMessageId,
        string $content,
        string $originalName,
        string $mime,
        string $extension
    ) : ChatMessageDocument;

    /**
     * This method provides creating data
     *
     * @param string $chatMessageId
     * @param array $chatMessageDocumentFiles
     *
     * @return Collection
     */
    public function createDocuments(
        string $chatMessageId,
        array $chatMessageDocumentFiles
    ) : Collection;

    /**
     * This method provides deleting data
     *
     * @param ChatMessageDocument $chatMessageDocument
     *
     * @return bool
     */
    public function deleteDocument(
        ChatMessageDocument $chatMessageDocument
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $chatMessageDocuments
     *
     * @return bool
     */
    public function deleteDocuments(
        Collection $chatMessageDocuments
    ) : bool;
}
