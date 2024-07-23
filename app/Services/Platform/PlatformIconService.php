<?php

namespace App\Services\Platform;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\PlatformIcon;
use App\Repositories\Platform\PlatformIconRepository;
use App\Services\File\FileService;
use App\Services\Platform\Interfaces\PlatformIconServiceInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class PlatformIconService
 *
 * @package App\Services\Platform
 */
final class PlatformIconService extends FileService implements PlatformIconServiceInterface
{
    /**
     * @var string
     */
    protected const ENVIRONMENT = 'public';

    /**
     * Icon files storage name
     */
    protected const FOLDER = 'platform_icons';

    /**
     * @var PlatformIconRepository
     */
    protected PlatformIconRepository $platformIconRepository;

    /**
     * PlatformIconService constructor
     */
    public function __construct()
    {
        /** @var PlatformIconRepository platformIconRepository */
        $this->platformIconRepository = new PlatformIconRepository();
    }

    /**
     * @param string $platformId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return PlatformIcon
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createIcon(
        string $platformId,
        string $content,
        string $mime,
        string $extension
    ) : PlatformIcon
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
         * Creating platform icon
         */
        return $this->platformIconRepository->store(
            $platformId,
            $filePath,
            $mime
        );
    }

    /**
     * @param string $platformId
     * @param array $platformIconFiles
     *
     * @return Collection
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createIcons(
        string $platformId,
        array $platformIconFiles
    ) : Collection
    {
        /**
         * Preparing a platform icon collection
         */
        $platformIcons = new Collection();

        /** @var array $platformIconFile */
        foreach ($platformIconFiles as $platformIconFile) {

            /**
             * Pushing created platform icon to response
             */
            $platformIcons->push(
                $this->createIcon(
                    $platformId,
                    $platformIconFile['content'],
                    $platformIconFile['mime'],
                    $platformIconFile['extension']
                )
            );
        }

        return $platformIcons;
    }

    /**
     * @param PlatformIcon $platformIcon
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteIcon(
        PlatformIcon $platformIcon
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $platformIcon->url
        );

        /**
         * Deleting platform icon
         */
        return $this->platformIconRepository->delete(
            $platformIcon
        );
    }

    /**
     * @param Collection $platformIcons
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteIcons(
        Collection $platformIcons
    ) : bool
    {
        /** @var PlatformIcon $platformIcon */
        foreach ($platformIcons as $platformIcon) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $platformIcon->url
            );
        }

        /**
         * Deleting platform icons
         */
        return $this->platformIconRepository->deleteByIds(
            $platformIcons->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
