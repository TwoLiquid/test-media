<?php

namespace App\Services\Admin;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\AdminAvatar;
use App\Repositories\Admin\AdminAvatarRepository;
use App\Services\Admin\Interfaces\AdminAvatarServiceInterface;
use App\Services\File\FileService;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class AdminAvatarService
 *
 * @package App\Services\Admin
 */
final class AdminAvatarService extends FileService implements AdminAvatarServiceInterface
{
    /**
     * @var string
     */
    protected const ENVIRONMENT = 'public';

    /**
     * Image files storage name
     */
    protected const FOLDER = 'admin_avatars';

    /**
     * @var AdminAvatarRepository
     */
    protected AdminAvatarRepository $adminAvatarRepository;

    /**
     * AdminAvatarService constructor
     */
    public function __construct()
    {
        /** @var AdminAvatarRepository adminAvatarRepository */
        $this->adminAvatarRepository = new AdminAvatarRepository();
    }

    /**
     * @param string $authId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return AdminAvatar
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createAvatar(
        string $authId,
        string $content,
        string $mime,
        string $extension
    ) : AdminAvatar
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
         * Creating thumbnail file
         */
        $this->createImageThumbnailFile(
            $filePath
        );

        /**
         * Creating admin avatar
         */
        return $this->adminAvatarRepository->store(
            $authId,
            $filePath,
            $mime
        );
    }

    /**
     * @param AdminAvatar $adminAvatar
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteAvatar(
        AdminAvatar $adminAvatar
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $adminAvatar->url
        );

        /**
         * Deleting thumbnail file from storage
         */
        $this->deleteImageThumbnailFile(
            $adminAvatar->url
        );

        /**
         * Deleting admin avatar
         */
        return $this->adminAvatarRepository->delete(
            $adminAvatar
        );
    }

    /**
     * @param Collection $adminAvatars
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteAvatars(
        Collection $adminAvatars
    ) : bool
    {
        /** @var AdminAvatar $adminAvatar */
        foreach ($adminAvatars as $adminAvatar) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $adminAvatar->url
            );

            /**
             * Deleting thumbnail file from storage
             */
            $this->deleteImageThumbnailFile(
                $adminAvatar->url
            );
        }

        /**
         * Deleting admin avatars
         */
        return $this->adminAvatarRepository->deleteByIds(
            $adminAvatars->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
