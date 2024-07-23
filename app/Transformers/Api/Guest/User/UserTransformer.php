<?php

namespace App\Transformers\Api\Guest\User;

use App\Transformers\Api\Guest\User\Activity\ActivityImageTransformer;
use App\Transformers\Api\Guest\User\Vybe\VybeImageTransformer;
use App\Transformers\Api\Guest\User\Vybe\VybeVideoTransformer;
use App\Transformers\BaseTransformer;
use League\Fractal\Resource\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

/**
 * Class UserTransformer
 *
 * @package App\Transformers\Api\Guest\User
 */
class UserTransformer extends BaseTransformer
{
    /**
     * @var EloquentCollection|null
     */
    protected ?EloquentCollection $userAvatars;

    /**
     * @var EloquentCollection|null
     */
    protected ?EloquentCollection $userVoiceSamples;

    /**
     * @var EloquentCollection|null
     */
    protected ?EloquentCollection $userBackgrounds;

    /**
     * @var EloquentCollection|null
     */
    protected ?EloquentCollection $userImages;

    /**
     * @var EloquentCollection|null
     */
    protected ?EloquentCollection $userVideos;

    /**
     * @var EloquentCollection|null
     */
    protected ?EloquentCollection $vybeImages;

    /**
     * @var EloquentCollection|null
     */
    protected ?EloquentCollection $vybeVideos;

    /**
     * @var EloquentCollection|null
     */
    protected ?EloquentCollection $activityImages;

    /**
     * @var array
     */
    protected array $defaultIncludes = [
        'user_avatars',
        'user_voice_samples',
        'user_backgrounds',
        'user_images',
        'user_videos',
        'vybe_images',
        'vybe_videos',
        'activity_images'
    ];

    /**
     * UserTransformer constructor
     *
     * @param EloquentCollection|null $userAvatars
     * @param EloquentCollection|null $userVoiceSamples
     * @param EloquentCollection|null $userBackgrounds
     * @param EloquentCollection|null $userImages
     * @param EloquentCollection|null $userVideos
     * @param EloquentCollection|null $vybeImages
     * @param EloquentCollection|null $vybeVideos
     * @param EloquentCollection|null $activityImages
     */
    public function __construct(
        ?EloquentCollection $userAvatars = null,
        ?EloquentCollection $userVoiceSamples = null,
        ?EloquentCollection $userBackgrounds = null,
        ?EloquentCollection $userImages = null,
        ?EloquentCollection $userVideos = null,
        ?EloquentCollection $vybeImages = null,
        ?EloquentCollection $vybeVideos = null,
        ?EloquentCollection $activityImages = null
    )
    {
        $this->userAvatars = $userAvatars;
        $this->userBackgrounds = $userBackgrounds;
        $this->userVoiceSamples = $userVoiceSamples;
        $this->userImages = $userImages;
        $this->userVideos = $userVideos;
        $this->vybeImages = $vybeImages;
        $this->vybeVideos = $vybeVideos;
        $this->activityImages = $activityImages;
    }

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

        return $userAvatars ? $this->collection($userAvatars, new UserAvatarTransformer) : null;
    }

    /**
     * @return Collection|null
     */
    public function includeUserVoiceSamples() : ?Collection
    {
        $userVoiceSamples = $this->userVoiceSamples;

        return $userVoiceSamples ? $this->collection($userVoiceSamples, new UserVoiceSampleTransformer) : null;
    }

    /**
     * @return Collection|null
     */
    public function includeUserBackgrounds() : ?Collection
    {
        $userBackgrounds = $this->userBackgrounds;

        return $userBackgrounds ? $this->collection($userBackgrounds, new UserBackgroundTransformer) : null;
    }

    /**
     * @return Collection|null
     */
    public function includeUserImages() : ?Collection
    {
        $userImages = $this->userImages;

        return $userImages ? $this->collection($userImages, new UserImageTransformer) : null;
    }

    /**
     * @return Collection|null
     */
    public function includeUserVideos() : ?Collection
    {
        $userVideos = $this->userVideos;

        return $userVideos ? $this->collection($userVideos, new UserVideoTransformer) : null;
    }

    /**
     * @return Collection|null
     */
    public function includeVybeImages() : ?Collection
    {
        $vybeImages = $this->vybeImages;

        return $vybeImages ? $this->collection($vybeImages, new VybeImageTransformer) : null;
    }

    /**
     * @return Collection|null
     */
    public function includeVybeVideos() : ?Collection
    {
        $vybeVideos = $this->vybeVideos;

        return $vybeVideos ? $this->collection($vybeVideos, new VybeVideoTransformer) : null;
    }

    /**
     * @return Collection|null
     */
    public function includeActivityImages() : ?Collection
    {
        $activityImages = $this->activityImages;

        return $activityImages ? $this->collection($activityImages, new ActivityImageTransformer) : null;
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'user';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'users';
    }
}
