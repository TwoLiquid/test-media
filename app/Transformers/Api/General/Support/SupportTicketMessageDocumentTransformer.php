<?php

namespace App\Transformers\Api\General\Support;

use App\Models\MySql\Support\SupportTicketMessageDocument;
use App\Transformers\BaseTransformer;

/**
 * Class SupportTicketMessageDocumentTransformer
 *
 * @package App\Transformers\Api\General\Support
 */
class SupportTicketMessageDocumentTransformer extends BaseTransformer
{
    /**
     * @param SupportTicketMessageDocument $supportTicketMessageDocument
     *
     * @return array
     */
    public function transform(SupportTicketMessageDocument $supportTicketMessageDocument) : array
    {
        return [
            'id'            => $supportTicketMessageDocument->id,
            'message_id'    => $supportTicketMessageDocument->message_id,
            'url' => route('api.support.ticket.message.document.download', [
                'id' => $supportTicketMessageDocument->id
            ]),
            'original_name' => $supportTicketMessageDocument->original_name,
            'size'          => $supportTicketMessageDocument->size,
            'mime'          => $supportTicketMessageDocument->mime,
            'created_at'    => $supportTicketMessageDocument->created_at
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'support_ticket_message_document';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'support_ticket_message_documents';
    }
}
