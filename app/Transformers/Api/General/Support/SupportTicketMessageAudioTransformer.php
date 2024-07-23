<?php

namespace App\Transformers\Api\General\Support;

use App\Models\MySql\Support\SupportTicketMessageAudio;
use App\Transformers\BaseTransformer;

/**
 * Class SupportTicketMessageAudioTransformer
 *
 * @package App\Transformers\Api\General\Support
 */
class SupportTicketMessageAudioTransformer extends BaseTransformer
{
    /**
     * @param SupportTicketMessageAudio $supportTicketMessageAudio
     *
     * @return array
     */
    public function transform(SupportTicketMessageAudio $supportTicketMessageAudio) : array
    {
        return [
            'id'         => $supportTicketMessageAudio->id,
            'message_id' => $supportTicketMessageAudio->message_id,
            'url' => route('api.support.ticket.message.audio.download', [
                'id' => $supportTicketMessageAudio->id
            ]),
            'duration'   => $supportTicketMessageAudio->duration,
            'size'       => $supportTicketMessageAudio->size,
            'mime'       => $supportTicketMessageAudio->mime,
            'created_at' => $supportTicketMessageAudio->created_at
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'support_ticket_message_audio';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'support_ticket_message_audios';
    }
}
