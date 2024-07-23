<?php

namespace App\Services\Device;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\DeviceIcon;
use App\Repositories\Device\DeviceIconRepository;
use App\Services\Device\Interfaces\DeviceIconServiceInterface;
use App\Services\File\FileService;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class DeviceIconService
 *
 * @package App\Services\Device
 */
final class DeviceIconService extends FileService implements DeviceIconServiceInterface
{
    /**
     * @var string
     */
    protected const ENVIRONMENT = 'public';

    /**
     * Icon files storage name
     */
    protected const FOLDER = 'device_icons';

    /**
     * @var DeviceIconRepository
     */
    protected DeviceIconRepository $deviceIconRepository;

    /**
     * DeviceIconService constructor
     */
    public function __construct()
    {
        /** @var DeviceIconRepository deviceIconRepository */
        $this->deviceIconRepository = new DeviceIconRepository();
    }

    /**
     * @param string $deviceId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return DeviceIcon
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createIcon(
        string $deviceId,
        string $content,
        string $mime,
        string $extension
    ) : DeviceIcon
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
         * Creating device icon
         */
        return $this->deviceIconRepository->store(
            $deviceId,
            $filePath,
            $mime
        );
    }

    /**
     * @param string $deviceId
     * @param array $deviceIconFiles
     *
     * @return Collection
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createIcons(
        string $deviceId,
        array $deviceIconFiles
    ) : Collection
    {
        /**
         * Preparing device icon collection
         */
        $deviceIcons = new Collection();

        /** @var array $deviceIconFile */
        foreach ($deviceIconFiles as $deviceIconFile) {

            /**
             * Pushing created device icon to response
             */
            $deviceIcons->push(
                $this->createIcon(
                    $deviceId,
                    $deviceIconFile['content'],
                    $deviceIconFile['mime'],
                    $deviceIconFile['extension']
                )
            );
        }

        return $deviceIcons;
    }

    /**
     * @param DeviceIcon $deviceIcon
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteIcon(
        DeviceIcon $deviceIcon
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $deviceIcon->url
        );

        /**
         * Deleting device icon
         */
        return $this->deviceIconRepository->delete(
            $deviceIcon
        );
    }

    /**
     * @param Collection $deviceIcons
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteIcons(
        Collection $deviceIcons
    ) : bool
    {
        /** @var DeviceIcon $deviceIcon */
        foreach ($deviceIcons as $deviceIcon) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $deviceIcon->url
            );
        }

        /**
         * Deleting device icons
         */
        return $this->deviceIconRepository->deleteByIds(
            $deviceIcons->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
