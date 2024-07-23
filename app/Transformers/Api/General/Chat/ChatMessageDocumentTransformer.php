<?php

namespace App\Transformers\Api\General\Chat;

use App\Models\MySql\Chat\ChatMessageDocument;
use App\Transformers\BaseTransformer;

/**
 * Class ChatMessageDocumentTransformer
 *
 * @package App\Transformers\Api\General\Chat
 */
class ChatMessageDocumentTransformer extends BaseTransformer
{
    /**
     * @param ChatMessageDocument $chatMessageDocument
     *
     * @return array
     */
    public function transform(ChatMessageDocument $chatMessageDocument) : array
    {
        return [
            'id'            => $chatMessageDocument->id,
            'message_id'    => $chatMessageDocument->message_id,
            'url' => route('api.chat.message.document.download', [
                'id' => $chatMessageDocument->id
            ]),
            'original_name' => $chatMessageDocument->original_name,
            'size'          => $chatMessageDocument->size,
            'mime'          => $chatMessageDocument->mime,
            'created_at'    => $chatMessageDocument->created_at
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'chat_message_document';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'chat_message_documents';
    }
}
