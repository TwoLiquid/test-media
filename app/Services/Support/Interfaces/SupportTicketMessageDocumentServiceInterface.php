<?php

namespace App\Services\Support\Interfaces;

use App\Models\MySql\Support\SupportTicketMessageDocument;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface SupportTicketMessageDocumentServiceInterface
 *
 * @package App\Services\Support\Interfaces
 */
interface SupportTicketMessageDocumentServiceInterface
{
    /**
     * This method provides creating data
     *
     * @param string $messageId
     * @param string $content
     * @param string $originalName
     * @param string $mime
     * @param string $extension
     *
     * @return SupportTicketMessageDocument
     */
    public function createDocument(
        string $messageId,
        string $content,
        string $originalName,
        string $mime,
        string $extension
    ) : SupportTicketMessageDocument;

    /**
     * This method provides creating data
     *
     * @param string $messageId
     * @param array $documentFiles
     *
     * @return Collection
     */
    public function createDocuments(
        string $messageId,
        array $documentFiles
    ) : Collection;

    /**
     * This method provides deleting data
     *
     * @param SupportTicketMessageDocument $supportTicketMessageDocument
     *
     * @return bool
     */
    public function deleteDocument(
        SupportTicketMessageDocument $supportTicketMessageDocument
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $supportTicketMessageDocuments
     *
     * @return bool
     */
    public function deleteDocuments(
        Collection $supportTicketMessageDocuments
    ) : bool;
}
