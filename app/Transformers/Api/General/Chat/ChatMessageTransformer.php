<?php

namespace App\Transformers\Api\General\Chat;

use App\Transformers\BaseTransformer;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use League\Fractal\Resource\Collection;

/**
 * Class ChatMessageTransformer
 *
 * @package App\Transformers\Api\General\Chat
 */
class ChatMessageTransformer extends BaseTransformer
{
    /**
     * @var EloquentCollection
     */
    protected EloquentCollection $chatMessagesAudios;

    /**
     * @var EloquentCollection
     */
    protected EloquentCollection $chatMessagesDocuments;

    /**
     * @var EloquentCollection
     */
    protected EloquentCollection $chatMessagesImages;

    /**
     * @var EloquentCollection
     */
    protected EloquentCollection $chatMessagesVideos;

    /**
     * @var EloquentCollection
     */
    protected EloquentCollection $usersAvatars;

    /**
     * ChatMessageTransformer constructor
     *
     * @param EloquentCollection $chatMessagesAudios
     * @param EloquentCollection $chatMessagesDocuments
     * @param EloquentCollection $chatMessagesImages
     * @param EloquentCollection $chatMessagesVideos
     * @param EloquentCollection $usersAvatars
     */
    public function __construct(
        EloquentCollection $chatMessagesAudios,
        EloquentCollection $chatMessagesDocuments,
        EloquentCollection $chatMessagesImages,
        EloquentCollection $chatMessagesVideos,
        EloquentCollection $usersAvatars
    )
    {
        $this->chatMessagesAudios = $chatMessagesAudios;
        $this->chatMessagesDocuments = $chatMessagesDocuments;
        $this->chatMessagesImages = $chatMessagesImages;
        $this->chatMessagesVideos = $chatMessagesVideos;
        $this->usersAvatars = $usersAvatars;
    }

    /**
     * @var array
     */
    protected array $defaultIncludes = [
        'chat_message_audios',
        'chat_message_documents',
        'chat_message_images',
        'chat_message_videos'
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
    public function includeChatMessageAudios() : ?Collection
    {
        $chatMessagesAudios = $this->chatMessagesAudios;

        return $this->collection($chatMessagesAudios, new ChatMessageAudioTransformer);
    }

    /**
     * @return Collection|null
     */
    public function includeChatMessageDocuments() : ?Collection
    {
        $chatMessagesDocuments = $this->chatMessagesDocuments;

        return $this->collection($chatMessagesDocuments, new ChatMessageDocumentTransformer);
    }

    /**
     * @return Collection|null
     */
    public function includeChatMessageImages() : ?Collection
    {
        $chatMessagesImages = $this->chatMessagesImages;

        return $this->collection($chatMessagesImages, new ChatMessageImageTransformer);
    }

    /**
     * @return Collection|null
     */
    public function includeChatMessageVideos() : ?Collection
    {
        $chatMessagesVideos = $this->chatMessagesVideos;

        return $this->collection($chatMessagesVideos, new ChatMessageVideoTransformer);
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
        return 'chat_message';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'chat_messages';
    }
}
