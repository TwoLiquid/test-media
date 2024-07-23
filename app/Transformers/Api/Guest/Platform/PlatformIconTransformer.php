<?php

namespace App\Transformers\Api\Guest\Platform;

use App\Models\MySql\PlatformIcon;
use App\Transformers\BaseTransformer;

/**
 * Class PlatformIconTransformer
 *
 * @package App\Transformers\Api\Guest\Platform
 */
class PlatformIconTransformer extends BaseTransformer
{
    /**
     * @param PlatformIcon $platformIcon
     *
     * @return array
     */
    public function transform(PlatformIcon $platformIcon) : array
    {
        return [
            'id'          => $platformIcon->id,
            'platform_id' => $platformIcon->platform_id,
            'url'         => generateFullStorageLink($platformIcon->url),
            'mime'        => $platformIcon->mime
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'platform_icon';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'platform_icons';
    }
}
