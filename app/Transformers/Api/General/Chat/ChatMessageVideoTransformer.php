<?php

namespace App\Transformers\Api\General\Chat;

use App\Models\MySql\Chat\ChatMessageVideo;
use App\Transformers\BaseTransformer;
use League\Fractal\Resource\Item;

/**
 * Class ChatMessageVideoTransformer
 *
 * @package App\Transformers\Api\General\Chat
 */
class ChatMessageVideoTransformer extends BaseTransformer
{
    /**
     * @var array
     */
    protected array $defaultIncludes = [
        'thumbnail'
    ];

    /**
     * @param ChatMessageVideo $chatMessageVideo
     *
     * @return array
     */
    public function transform(ChatMessageVideo $chatMessageVideo) : array
    {
        return [
            'id'            => $chatMessageVideo->id,
            'message_id'    => $chatMessageVideo->message_id,
            'url' => route('api.chat.message.video.download', [
                'id' => $chatMessageVideo->id
            ]),
            'duration'      => $chatMessageVideo->duration,
            'size'          => $chatMessageVideo->size,
            'mime'          => $chatMessageVideo->mime,
            'created_at'    => $chatMessageVideo->created_at
        ];
    }

    /**
     * @param ChatMessageVideo $chatMessageVideo
     *
     * @return Item|null
     */
    public function includeThumbnail(ChatMessageVideo $chatMessageVideo): ?Item
    {
        $thumbnail = $chatMessageVideo->thumbnail;

        return $thumbnail ? $this->item($thumbnail, new ChatMessageVideoThumbnailTransformer) : null;
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'chat_message_video';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'chat_message_videos';
    }
}
