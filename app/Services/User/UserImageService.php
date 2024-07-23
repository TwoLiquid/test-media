<?php

namespace App\Services\User;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\User\UserImage;
use App\Repositories\User\UserImageRepository;
use App\Services\File\FileService;
use App\Services\User\Interfaces\UserImageServiceInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class UserImageService
 *
 * @package App\Services\User
 */
final class UserImageService extends FileService implements UserImageServiceInterface
{
    /**
     * @var string
     */
    protected const ENVIRONMENT = 'public';

    /**
     * Image files storage name
     */
    protected const FOLDER = 'user_images';

    /**
     * @var UserImageRepository
     */
    protected UserImageRepository $userImageRepository;

    /**
     * UserImageService constructor
     */
    public function __construct()
    {
        /** @var UserImageRepository userImageRepository */
        $this->userImageRepository = new UserImageRepository();
    }

    /**
     * @param int $authId
     * @param string $content
     * @param string $mime
     * @param string $extension
     * @param string|null $requestId
     *
     * @return UserImage
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
    ) : UserImage
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
         * Creating user image
         */
        return $this->userImageRepository->store(
            $authId,
            $requestId,
            $filePath,
            $mime
        );
    }

    /**
     * @param int $authId
     * @param array $userImageFiles
     *
     * @return Collection
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createImages(
        int $authId,
        array $userImageFiles
    ) : Collection
    {
        /**
         * Preparing a user images collection
         */
        $userImages = new Collection();

        /** @var array $userImageFile */
        foreach ($userImageFiles as $userImageFile) {

            /**
             * Pushing created user image to response
             */
            $userImages->push(
                $this->createImage(
                    $authId,
                    $userImageFile['content'],
                    $userImageFile['mime'],
                    $userImageFile['extension'],
                    $userImageFile['request_id'] ?? null
                )
            );
        }

        return $userImages;
    }

    /**
     * @param UserImage $userImage
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteImage(
        UserImage $userImage
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $userImage->url
        );

        /**
         * Deleting thumbnail file from storage
         */
        $this->deleteImageThumbnailFile(
            $userImage->url
        );

        /**
         * Deleting user image
         */
        return $this->userImageRepository->delete(
            $userImage
        );
    }

    /**
     * @param Collection $userImages
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteImages(
        Collection $userImages
    ) : bool
    {
        /** @var UserImage $userImage */
        foreach ($userImages as $userImage) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $userImage->url
            );

            /**
             * Deleting thumbnail file from storage
             */
            $this->deleteImageThumbnailFile(
                $userImage->url
            );
        }

        /**
         * Deleting user images
         */
        return $this->userImageRepository->deleteByIds(
            $userImages->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
