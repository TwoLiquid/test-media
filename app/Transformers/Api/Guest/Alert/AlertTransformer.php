<?php

namespace App\Transformers\Api\Guest\Alert;

use App\Transformers\BaseTransformer;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use League\Fractal\Resource\Collection;

/**
 * Class AlertTransformer
 *
 * @package App\Transformers\Api\Guest\Alert
 */
class AlertTransformer extends BaseTransformer
{
    /**
     * @var EloquentCollection
     */
    protected EloquentCollection $alertImages;

    /**
     * @var EloquentCollection
     */
    protected EloquentCollection $alertSounds;

    /**
     * AlertTransformer constructor
     *
     * @param EloquentCollection $alertImages
     * @param EloquentCollection $alertSounds
     */
    public function __construct(
        EloquentCollection $alertImages,
        EloquentCollection $alertSounds
    )
    {
        $this->alertImages = $alertImages;
        $this->alertSounds = $alertSounds;
    }

    /**
     * @var array
     */
    protected array $defaultIncludes = [
        'alert_images',
        'alert_sounds'
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
    public function includeAlertImages() : ?Collection
    {
        $alertImages = $this->alertImages;

        return $this->collection($alertImages, new AlertImageTransformer);
    }

    /**
     * @return Collection|null
     */
    public function includeAlertSounds() : ?Collection
    {
        $alertSounds = $this->alertSounds;

        return $this->collection($alertSounds, new AlertSoundTransformer);
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'alert';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'alerts';
    }
}
