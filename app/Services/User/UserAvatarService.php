<?php

namespace App\Services\User;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\User\UserAvatar;
use App\Repositories\User\UserAvatarRepository;
use App\Services\File\FileService;
use App\Services\User\Interfaces\UserAvatarServiceInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class UserAvatarService
 *
 * @package App\Services\User
 */
final class UserAvatarService extends FileService implements UserAvatarServiceInterface
{
    /**
     * @var string
     */
    protected const ENVIRONMENT = 'public';

    /**
     * Image files storage name
     */
    protected const FOLDER = 'user_avatars';

    /**
     * @var UserAvatarRepository
     */
    protected UserAvatarRepository $userAvatarRepository;

    /**
     * UserAvatarService constructor
     */
    public function __construct()
    {
        /** @var UserAvatarRepository userAvatarRepository */
        $this->userAvatarRepository = new UserAvatarRepository();
    }

    /**
     * @param int $authId
     * @param string $content
     * @param string $mime
     * @param string $extension
     * @param string|null $requestId
     *
     * @return UserAvatar
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createImage(
        int $authId,
        string $content,
        string $mime,
        string $extension,
        ?string $requestId = null
    ) : UserAvatar
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
         * Creating user avatar
         */
        return $this->userAvatarRepository->store(
            $authId,
            $requestId,
            $filePath,
            $mime
        );
    }

    /**
     * @param int $authId
     * @param array $userAvatarFiles
     *
     * @return Collection
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createImages(
        int $authId,
        array $userAvatarFiles
    ) : Collection
    {
        /**
         * Preparing a user avatars collection
         */
        $userAvatars = new Collection();

        /** @var array $userAvatarFile */
        foreach ($userAvatarFiles as $userAvatarFile) {

            /**
             * Pushing created user avatars to response
             */
            $userAvatars->push(
                $this->createImage(
                    $authId,
                    $userAvatarFile['content'],
                    $userAvatarFile['mime'],
                    $userAvatarFile['extension']
                )
            );
        }

        return $userAvatars;
    }

    /**
     * @param UserAvatar $userAvatar
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteImage(
        UserAvatar $userAvatar
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $userAvatar->url
        );

        /**
         * Deleting thumbnail file from storage
         */
        $this->deleteImageThumbnailFile(
            $userAvatar->url
        );

        /**
         * Deleting user avatar
         */
        return $this->userAvatarRepository->delete(
            $userAvatar
        );
    }

    /**
     * @param Collection $userAvatars
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteImages(
        Collection $userAvatars
    ) : bool
    {
        /** @var UserAvatar $userAvatar */
        foreach ($userAvatars as $userAvatar) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $userAvatar->url
            );

            /**
             * Deleting thumbnail file from storage
             */
            $this->deleteImageThumbnailFile(
                $userAvatar->url
            );
        }

        /**
         * Deleting user avatars
         */
        return $this->userAvatarRepository->deleteByIds(
            $userAvatars->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
