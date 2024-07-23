<?php

namespace App\Transformers\Api\General\Device;

use App\Models\MySql\DeviceIcon;
use App\Transformers\BaseTransformer;

/**
 * Class DeviceIconTransformer
 *
 * @package App\Transformers\Api\General\Device
 */
class DeviceIconTransformer extends BaseTransformer
{
    /**
     * @param DeviceIcon $deviceIcon
     *
     * @return array
     */
    public function transform(DeviceIcon $deviceIcon) : array
    {
        return [
            'id'        => $deviceIcon->id,
            'device_id' => $deviceIcon->device_id,
            'url'       => generateFullStorageLink($deviceIcon->url),
            'mime'      => $deviceIcon->mime
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'device_icon';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'device_icons';
    }
}
