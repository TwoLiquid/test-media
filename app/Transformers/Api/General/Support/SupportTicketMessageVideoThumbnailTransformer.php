<?php

namespace App\Transformers\Api\General\Support;

use App\Models\MySql\Support\SupportTicketMessageVideoThumbnail;
use App\Transformers\BaseTransformer;

/**
 * Class SupportTicketMessageVideoThumbnailTransformer
 *
 * @package App\Transformers\Api\General\Support
 */
class SupportTicketMessageVideoThumbnailTransformer extends BaseTransformer
{
    /**
     * @param SupportTicketMessageVideoThumbnail $supportTicketMessageVideoThumbnail
     *
     * @return array
     */
    public function transform(SupportTicketMessageVideoThumbnail $supportTicketMessageVideoThumbnail) : array
    {
        return [
            'id'  => $supportTicketMessageVideoThumbnail->id,
            'url' => route('api.support.ticket.message.video.thumbnail.download', [
                'id' => $supportTicketMessageVideoThumbnail->id
            ]),
            'url_min' => route('api.support.ticket.message.video.thumbnail.download.min', [
                'id' => $supportTicketMessageVideoThumbnail->id
            ]),
            'mime' => $supportTicketMessageVideoThumbnail->mime
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'support_ticket_message_video_thumbnail';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'support_ticket_message_video_thumbnails';
    }
}
