<?php

namespace App\Services\Alert;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\Alert\AlertSound;
use App\Repositories\Alert\AlertSoundRepository;
use App\Services\Alert\Interfaces\AlertSoundServiceInterface;
use App\Services\File\FileService;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class AlertSoundService
 *
 * @package App\Services\Alert
 */
final class AlertSoundService extends FileService implements AlertSoundServiceInterface
{
    /**
     * @var string
     */
    protected const ENVIRONMENT = 'public';

    /**
     * Sound files storage name
     */
    protected const FOLDER = 'alert_sounds';

    /**
     * @var AlertSoundRepository
     */
    protected AlertSoundRepository $alertSoundRepository;

    /**
     * AlertSoundService constructor
     */
    public function __construct()
    {
        /** @var AlertSoundRepository alertSoundRepository */
        $this->alertSoundRepository = new AlertSoundRepository();
    }

    /**
     * @param string $alertId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return AlertSound
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createSound(
        string $alertId,
        string $content,
        string $mime,
        string $extension
    ) : AlertSound
    {
        /**
         * Uploading file
         */
        $filePath = $this->uploadFile(
            $content,
            $extension,
            self::FOLDER
        );

        /**
         * Getting file duration
         */
        $duration = $this->getFileDuration(
            $filePath
        );

        /**
         * Creating alert sound
         */
        return $this->alertSoundRepository->store(
            $alertId,
            $filePath,
            $duration,
            $mime
        );
    }

    /**
     * @param string $alertId
     * @param array $alertSoundFiles
     *
     * @return Collection
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createSounds(
        string $alertId,
        array $alertSoundFiles
    ) : Collection
    {
        /**
         * Preparing alert sounds collection
         */
        $alertSounds = new Collection();

        /** @var array $alertSoundFile */
        foreach ($alertSoundFiles as $alertSoundFile) {

            /**
             * Pushing created alert sound to response
             */
            $alertSounds->push(
                $this->createSound(
                    $alertId,
                    $alertSoundFile['content'],
                    $alertSoundFile['mime'],
                    $alertSoundFile['extension']
                )
            );
        }

        return $alertSounds;
    }

    /**
     * @param AlertSound $alertSound
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteSound(
        AlertSound $alertSound
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $alertSound->url
        );

        /**
         * Deleting alert sound
         */
        return $this->alertSoundRepository->delete(
            $alertSound
        );
    }

    /**
     * @param Collection $alertSounds
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteSounds(
        Collection $alertSounds
    ) : bool
    {
        /** @var AlertSound $alertSound */
        foreach ($alertSounds as $alertSound) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $alertSound->url
            );
        }

        /**
         * Deleting alert sounds
         */
        return $this->alertSoundRepository->deleteByIds(
            $alertSounds->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
