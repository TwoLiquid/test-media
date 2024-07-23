<?php

namespace App\Services\Device\Interfaces;

use App\Models\MySql\DeviceIcon;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface DeviceIconServiceInterface
 *
 * @package App\Services\Device\Interfaces
 */
interface DeviceIconServiceInterface
{
    /**
     * This method provides creating data
     *
     * @param string $deviceId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return DeviceIcon
     */
    public function createIcon(
        string $deviceId,
        string $content,
        string $mime,
        string $extension
    ) : DeviceIcon;

    /**
     * This method provides creating data
     *
     * @param string $deviceId
     * @param array $deviceIconFiles
     *
     * @return Collection
     */
    public function createIcons(
        string $deviceId,
        array $deviceIconFiles
    ) : Collection;

    /**
     * This method provides deleting data
     *
     * @param DeviceIcon $deviceIcon
     *
     * @return bool
     */
    public function deleteIcon(
        DeviceIcon $deviceIcon
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $deviceIcons
     *
     * @return bool
     */
    public function deleteIcons(
        Collection $deviceIcons
    ) : bool;
}
