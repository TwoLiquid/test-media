<?php

namespace App\Services\Platform\Interfaces;

use App\Models\MySql\PlatformIcon;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface PlatformIconServiceInterface
 *
 * @package App\Services\Platform\Interfaces
 */
interface PlatformIconServiceInterface
{
    /**
     * This method provides creating data
     *
     * @param string $platformId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return PlatformIcon
     */
    public function createIcon(
        string $platformId,
        string $content,
        string $mime,
        string $extension
    ) : PlatformIcon;

    /**
     * This method provides creating data
     *
     * @param string $platformId
     * @param array $platformIconFiles
     *
     * @return Collection
     */
    public function createIcons(
        string $platformId,
        array $platformIconFiles
    ) : Collection;

    /**
     * This method provides deleting data
     *
     * @param PlatformIcon $platformIcon
     *
     * @return bool
     */
    public function deleteIcon(
        PlatformIcon $platformIcon
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $platformIcons
     *
     * @return bool
     */
    public function deleteIcons(
        Collection $platformIcons
    ) : bool;
}
