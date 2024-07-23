<?php

namespace App\Transformers\Api\Guest\Search;

use App\Transformers\Api\Guest\Search\Activity\ActivityImageTransformer;
use App\Transformers\Api\Guest\Search\User\UserAvatarTransformer;
use App\Transformers\Api\Guest\Search\User\UserVoiceSampleTransformer;
use App\Transformers\Api\Guest\Search\Vybe\VybeImageTransformer;
use App\Transformers\Api\Guest\Search\Vybe\VybeVideoTransformer;
use App\Transformers\BaseTransformer;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use League\Fractal\Resource\Collection;

/**
 * Class ClientGlobalTransformer
 *
 * @package App\Transformers\Api\Guest\Search
 */
class ClientGlobalTransformer extends BaseTransformer
{
    /**
     * @var EloquentCollection
     */
    protected EloquentCollection $userAvatars;

    /**
     * @var EloquentCollection
     */
    protected EloquentCollection $userVoiceSamples;

    /**
     * @var EloquentCollection
     */
    protected EloquentCollection $vybeImages;

    /**
     * @var EloquentCollection
     */
    protected EloquentCollection $vybeVideos;

    /**
     * @var EloquentCollection
     */
    protected EloquentCollection $activityImages;

    /**
     * ClientGlobalTransformer constructor
     *
     * @param EloquentCollection $userAvatars
     * @param EloquentCollection $userVoiceSamples
     * @param EloquentCollection $vybeImages
     * @param EloquentCollection $vybeVideos
     * @param EloquentCollection $activityImages
     */
    public function __construct(
        EloquentCollection $userAvatars,
        EloquentCollection $userVoiceSamples,
        EloquentCollection $vybeImages,
        EloquentCollection $vybeVideos,
        EloquentCollection $activityImages
    )
    {
        $this->userAvatars = $userAvatars;
        $this->userVoiceSamples = $userVoiceSamples;
        $this->vybeImages = $vybeImages;
        $this->vybeVideos = $vybeVideos;
        $this->activityImages = $activityImages;
    }

    /**
     * @var array
     */
    protected array $defaultIncludes = [
        'user_avatars',
        'user_voice_samples',
        'vybe_images',
        'vybe_videos',
        'activity_images'
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
    public function includeUserAvatars() : ?Collection
    {
        $userAvatars = $this->userAvatars;

        return $this->collection($userAvatars, new UserAvatarTransformer);
    }

    /**
     * @return Collection|null
     */
    public function includeUserVoiceSamples() : ?Collection
    {
        $userVoiceSamples = $this->userVoiceSamples;

        return $this->collection($userVoiceSamples, new UserVoiceSampleTransformer);
    }

    /**
     * @return Collection|null
     */
    public function includeVybeImages() : ?Collection
    {
        $vybeImages = $this->vybeImages;

        return $this->collection($vybeImages, new VybeImageTransformer);
    }

    /**
     * @return Collection|null
     */
    public function includeVybeVideos() : ?Collection
    {
        $vybeVideos = $this->vybeVideos;

        return $this->collection($vybeVideos, new VybeVideoTransformer);
    }

    /**
     * @return Collection|null
     */
    public function includeActivityImages() : ?Collection
    {
        $activityImages = $this->activityImages;

        return $this->collection($activityImages, new ActivityImageTransformer);
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'client_global';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'client_global';
    }
}
