<?php

namespace App\Transformers\Api\General\Support;

use App\Models\MySql\Support\SupportTicketMessageVideo;
use App\Transformers\BaseTransformer;
use League\Fractal\Resource\Item;

/**
 * Class SupportTicketMessageVideoTransformer
 *
 * @package App\Transformers\Api\General\Support
 */
class SupportTicketMessageVideoTransformer extends BaseTransformer
{
    /**
     * @var array
     */
    protected array $defaultIncludes = [
        'thumbnail'
    ];

    /**
     * @param SupportTicketMessageVideo $supportTicketMessageVideo
     *
     * @return array
     */
    public function transform(SupportTicketMessageVideo $supportTicketMessageVideo) : array
    {
        return [
            'id'            => $supportTicketMessageVideo->id,
            'message_id'    => $supportTicketMessageVideo->message_id,
            'url' => route('api.support.ticket.message.video.download', [
                'id' => $supportTicketMessageVideo->id
            ]),
            'duration'      => $supportTicketMessageVideo->duration,
            'size'          => $supportTicketMessageVideo->size,
            'mime'          => $supportTicketMessageVideo->mime,
            'created_at'    => $supportTicketMessageVideo->created_at
        ];
    }

    /**
     * @param SupportTicketMessageVideo $supportTicketMessageVideo
     *
     * @return Item|null
     */
    public function includeThumbnail(SupportTicketMessageVideo $supportTicketMessageVideo): ?Item
    {
        $thumbnail = $supportTicketMessageVideo->thumbnail;

        return $thumbnail ? $this->item($thumbnail, new SupportTicketMessageVideoThumbnailTransformer) : null;
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'support_ticket_message_video';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'support_ticket_message_videos';
    }
}
