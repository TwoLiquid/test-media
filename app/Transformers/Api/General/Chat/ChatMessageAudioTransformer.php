<?php

namespace App\Transformers\Api\General\Chat;

use App\Models\MySql\Chat\ChatMessageAudio;
use App\Transformers\BaseTransformer;

/**
 * Class ChatMessageAudioTransformer
 *
 * @package App\Transformers\Api\General\Chat
 */
class ChatMessageAudioTransformer extends BaseTransformer
{
    /**
     * @param ChatMessageAudio $chatMessageAudio
     *
     * @return array
     */
    public function transform(ChatMessageAudio $chatMessageAudio) : array
    {
        return [
            'id'         => $chatMessageAudio->id,
            'message_id' => $chatMessageAudio->message_id,
            'url' => route('api.chat.message.audio.download', [
                'id' => $chatMessageAudio->id
            ]),
            'duration'   => $chatMessageAudio->duration,
            'size'       => $chatMessageAudio->size,
            'mime'       => $chatMessageAudio->mime,
            'created_at' => $chatMessageAudio->created_at
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'chat_message_audio';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'chat_message_audios';
    }
}
