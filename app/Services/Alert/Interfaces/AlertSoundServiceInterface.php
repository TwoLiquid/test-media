<?php

namespace App\Services\Alert\Interfaces;

use App\Models\MySql\Alert\AlertSound;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface AlertSoundServiceInterface
 *
 * @package App\Services\Alert\Interfaces
 */
interface AlertSoundServiceInterface
{
    /**
     * This method provides creating data
     *
     * @param string $alertId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return AlertSound
     */
    public function createSound(
        string $alertId,
        string $content,
        string $mime,
        string $extension
    ) : AlertSound;

    /**
     * This method provides creating data
     *
     * @param string $alertId
     * @param array $alertSoundFiles
     *
     * @return Collection
     */
    public function createSounds(
        string $alertId,
        array $alertSoundFiles
    ) : Collection;

    /**
     * This method provides deleting data
     *
     * @param AlertSound $alertSound
     *
     * @return bool
     */
    public function deleteSound(
        AlertSound $alertSound
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $alertSounds
     *
     * @return bool
     */
    public function deleteSounds(
        Collection $alertSounds
    ) : bool;
}
