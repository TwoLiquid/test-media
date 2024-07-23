<?php

namespace App\Transformers\Api\General\Support;

use App\Transformers\BaseTransformer;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use League\Fractal\Resource\Collection;

/**
 * Class SupportTicketMessageTransformer
 *
 * @package App\Transformers\Api\General\Support
 */
class SupportTicketMessageTransformer extends BaseTransformer
{
    /**
     * @var EloquentCollection
     */
    protected EloquentCollection $supportTicketMessagesAudios;

    /**
     * @var EloquentCollection
     */
    protected EloquentCollection $supportTicketMessagesDocuments;

    /**
     * @var EloquentCollection
     */
    protected EloquentCollection $supportTicketMessagesImages;

    /**
     * @var EloquentCollection
     */
    protected EloquentCollection $supportTicketMessagesVideos;

    /**
     * @var EloquentCollection
     */
    protected EloquentCollection $usersAvatars;

    /**
     * ChatMessageTransformer constructor
     *
     * @param EloquentCollection $supportTicketMessagesAudios
     * @param EloquentCollection $supportTicketMessagesDocuments
     * @param EloquentCollection $supportTicketMessagesImages
     * @param EloquentCollection $supportTicketMessagesVideos
     * @param EloquentCollection $usersAvatars
     */
    public function __construct(
        EloquentCollection $supportTicketMessagesAudios,
        EloquentCollection $supportTicketMessagesDocuments,
        EloquentCollection $supportTicketMessagesImages,
        EloquentCollection $supportTicketMessagesVideos,
        EloquentCollection $usersAvatars
    )
    {
        /** @var EloquentCollection supportTicketMessagesAudios */
        $this->supportTicketMessagesAudios = $supportTicketMessagesAudios;

        /** @var EloquentCollection supportTicketMessagesDocuments */
        $this->supportTicketMessagesDocuments = $supportTicketMessagesDocuments;

        /** @var EloquentCollection supportTicketMessagesImages */
        $this->supportTicketMessagesImages = $supportTicketMessagesImages;

        /** @var EloquentCollection supportTicketMessagesVideos */
        $this->supportTicketMessagesVideos = $supportTicketMessagesVideos;

        /** @var EloquentCollection usersAvatars */
        $this->usersAvatars = $usersAvatars;
    }

    /**
     * @var array
     */
    protected array $defaultIncludes = [
        'support_ticket_message_audios',
        'support_ticket_message_documents',
        'support_ticket_message_images',
        'support_ticket_message_videos'
    ];

    /**
     * @return array
     */
    public function transform() : array
    {
        return [];
    }

    /**
     * @return Collection|null
     */
    public function includeSupportTicketMessageAudios() : ?Collection
    {
        $supportTicketMessagesAudios = $this->supportTicketMessagesAudios;

        return $this->collection($supportTicketMessagesAudios, new SupportTicketMessageAudioTransformer);
    }

    /**
     * @return Collection|null
     */
    public function includeSupportTicketMessageDocuments() : ?Collection
    {
        $supportTicketMessagesDocuments = $this->supportTicketMessagesDocuments;

        return $this->collection($supportTicketMessagesDocuments, new SupportTicketMessageDocumentTransformer);
    }

    /**
     * @return Collection|null
     */
    public function includeSupportTicketMessageImages() : ?Collection
    {
        $supportTicketMessagesImages = $this->supportTicketMessagesImages;

        return $this->collection($supportTicketMessagesImages, new SupportTicketMessageImageTransformer);
    }

    /**
     * @return Collection|null
     */
    public function includeSupportTicketMessageVideos() : ?Collection
    {
        $supportTicketMessagesVideos = $this->supportTicketMessagesVideos;

        return $this->collection($supportTicketMessagesVideos, new SupportTicketMessageVideoTransformer);
    }

    /**
     * @return Collection|null
     */
    public function includeUserAvatars() : ?Collection
    {
        $usersAvatars = $this->usersAvatars;

        return $this->collection($usersAvatars, new UserAvatarTransformer);
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'support_ticket_message';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'support_ticket_messages';
    }
}
