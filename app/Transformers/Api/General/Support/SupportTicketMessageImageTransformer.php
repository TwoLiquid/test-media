<?php

namespace App\Transformers\Api\General\Support;

use App\Models\MySql\Support\SupportTicketMessageImage;
use App\Transformers\BaseTransformer;

/**
 * Class SupportTicketMessageImageTransformer
 *
 * @package App\Transformers\Api\General\Support
 */
class SupportTicketMessageImageTransformer extends BaseTransformer
{
    /**
     * @param SupportTicketMessageImage $supportTicketMessageImage
     *
     * @return array
     */
    public function transform(SupportTicketMessageImage $supportTicketMessageImage) : array
    {
        return [
            'id'            => $supportTicketMessageImage->id,
            'message_id'    => $supportTicketMessageImage->message_id,
            'url' => route('api.support.ticket.message.image.download', [
                'id' => $supportTicketMessageImage->id
            ]),
            'url_min' => route('api.support.ticket.message.image.download.min', [
                'id' => $supportTicketMessageImage->id
            ]),
            'size'          => $supportTicketMessageImage->size,
            'mime'          => $supportTicketMessageImage->mime,
            'created_at'    => $supportTicketMessageImage->created_at
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'support_ticket_message_image';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'support_ticket_message_images';
    }
}
