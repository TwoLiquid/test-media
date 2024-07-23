<?php

namespace App\Transformers\Api\General\Chat;

use App\Models\MySql\Chat\ChatMessageVideoThumbnail;
use App\Transformers\BaseTransformer;

/**
 * Class ChatMessageVideoThumbnailTransformer
 *
 * @package App\Transformers\Api\General\Chat
 */
class ChatMessageVideoThumbnailTransformer extends BaseTransformer
{
    /**
     * @param ChatMessageVideoThumbnail $chatMessageVideoThumbnail
     *
     * @return array
     */
    public function transform(ChatMessageVideoThumbnail $chatMessageVideoThumbnail) : array
    {
        return [
            'id'  => $chatMessageVideoThumbnail->id,
            'url' => route('api.chat.message.video.thumbnail.download', [
                'id' => $chatMessageVideoThumbnail->id
            ]),
            'url_min' => route('api.chat.message.video.thumbnail.download.min', [
                'id' => $chatMessageVideoThumbnail->id
            ]),
            'mime' => $chatMessageVideoThumbnail->mime
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'chat_message_video_thumbnail';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'chat_message_video_thumbnails';
    }
}
