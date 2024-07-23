<?php

namespace App\Transformers\Api\Guest\Vybe;

use App\Models\MySql\Vybe\VybeVideoThumbnail;
use App\Transformers\BaseTransformer;

/**
 * Class VybeVideoThumbnailTransformer
 *
 * @package App\Transformers\Api\Guest\Vybe
 */
class VybeVideoThumbnailTransformer extends BaseTransformer
{
    /**
     * @param VybeVideoThumbnail $vybeVideoThumbnail
     *
     * @return array
     */
    public function transform(VybeVideoThumbnail $vybeVideoThumbnail) : array
    {
        return [
            'id'       => $vybeVideoThumbnail->id,
            'video_id' => $vybeVideoThumbnail->video_id,
            'url'      => generateFullStorageLink($vybeVideoThumbnail->url),
            'url_min'  => generateFullStorageLink(getMinimizedFilePath($vybeVideoThumbnail->url)),
            'mime'     => $vybeVideoThumbnail->mime
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'vybe_video_thumbnail';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'vybe_video_thumbnails';
    }
}
