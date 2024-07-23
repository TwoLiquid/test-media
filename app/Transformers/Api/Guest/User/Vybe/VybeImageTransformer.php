<?php

namespace App\Transformers\Api\Guest\User\Vybe;

use App\Models\MySql\Vybe\VybeImage;
use App\Transformers\BaseTransformer;

/**
 * Class VybeImageTransformer
 *
 * @package App\Transformers\Api\Guest\User\Vybe
 */
class VybeImageTransformer extends BaseTransformer
{
    /**
     * @param VybeImage $vybeImage
     *
     * @return array
     */
    public function transform(VybeImage $vybeImage) : array
    {
        return [
            'id'       => $vybeImage->id,
            'url'      => generateFullStorageLink($vybeImage->url),
            'url_min'  => generateFullStorageLink(getMinimizedFilePath($vybeImage->url)),
            'mime'     => $vybeImage->mime,
            'main'     => $vybeImage->main,
            'declined' => $vybeImage->declined
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'vybe_image';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'vybe_images';
    }
}
