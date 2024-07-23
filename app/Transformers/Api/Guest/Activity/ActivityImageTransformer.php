<?php

namespace App\Transformers\Api\Guest\Activity;

use App\Models\MySql\ActivityImage;
use App\Transformers\BaseTransformer;

/**
 * Class ActivityImageTransformer
 *
 * @package App\Transformers\Api\Guest\Activity
 */
class ActivityImageTransformer extends BaseTransformer
{
    /**
     * @param ActivityImage $activityImage
     *
     * @return array
     */
    public function transform(ActivityImage $activityImage) : array
    {
        return [
            'id'          => $activityImage->id,
            'activity_id' => $activityImage->activity_id,
            'type'        => $activityImage->type,
            'url'         => generateFullStorageLink($activityImage->url),
            'url_min'     => generateFullStorageLink(getMinimizedFilePath($activityImage->url)),
            'mime'        => $activityImage->mime
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'activity_image';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'activity_images';
    }
}
