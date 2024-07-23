<?php

namespace App\Transformers\Api\General\Chat;

use App\Models\MySql\Chat\ChatMessageImage;
use App\Transformers\BaseTransformer;

/**
 * Class ChatMessageImageTransformer
 *
 * @package App\Transformers\Api\General\Chat
 */
class ChatMessageImageTransformer extends BaseTransformer
{
    /**
     * @param ChatMessageImage $chatMessageImage
     *
     * @return array
     */
    public function transform(ChatMessageImage $chatMessageImage) : array
    {
        return [
            'id'            => $chatMessageImage->id,
            'message_id'    => $chatMessageImage->message_id,
            'url' => route('api.chat.message.image.download', [
                'id' => $chatMessageImage->id
            ]),
            'url_min' => route('api.chat.message.image.download.min', [
                'id' => $chatMessageImage->id
            ]),
            'size'          => $chatMessageImage->size,
            'mime'          => $chatMessageImage->mime,
            'created_at'    => $chatMessageImage->created_at
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'chat_message_image';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'chat_message_images';
    }
}
