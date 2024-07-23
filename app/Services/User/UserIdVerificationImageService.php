<?php

namespace App\Services\User;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\User\UserIdVerificationImage;
use App\Repositories\User\UserIdVerificationImageRepository;
use App\Services\File\FileService;
use App\Services\User\Interfaces\UserIdVerificationImageServiceInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class UserIdVerificationImageService
 *
 * @package App\Services\User
 */
final class UserIdVerificationImageService extends FileService implements UserIdVerificationImageServiceInterface
{
    /**
     * @var string
     */
    protected const ENVIRONMENT = 'public';

    /**
     * Image files storage name
     */
    protected const FOLDER = 'user_id_verification_images';

    /**
     * @var UserIdVerificationImageRepository
     */
    protected UserIdVerificationImageRepository $userIdVerificationImageRepository;

    /**
     * UserIdVerificationImageService constructor
     */
    public function __construct()
    {
        /** @var UserIdVerificationImageRepository userIdVerificationImageRepository */
        $this->userIdVerificationImageRepository = new UserIdVerificationImageRepository();
    }

    /**
     * @param int $authId
     * @param string $content
     * @param string $mime
     * @param string $extension
     * @param string|null $requestId
     *
     * @return UserIdVerificationImage
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
    ) : UserIdVerificationImage
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
         * Creating user id verification image
         */
        return $this->userIdVerificationImageRepository->store(
            $authId,
            $requestId,
            $filePath,
            $mime
        );
    }

    /**
     * @param int $authId
     * @param array $userIdVerificationImageFiles
     *
     * @return Collection
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createImages(
        int $authId,
        array $userIdVerificationImageFiles
    ) : Collection
    {
        /**
         * Preparing a user id verification images collection
         */
        $userIdVerificationImages = new Collection();

        /** @var array $userIdVerificationImageFile */
        foreach ($userIdVerificationImageFiles as $userIdVerificationImageFile) {

            /**
             * Pushing created user id verification images to response
             */
            $userIdVerificationImages->push(
                $this->createImage(
                    $authId,
                    $userIdVerificationImageFile['content'],
                    $userIdVerificationImageFile['mime'],
                    $userIdVerificationImageFile['extension']
                )
            );
        }

        return $userIdVerificationImages;
    }

    /**
     * @param UserIdVerificationImage $userIdVerificationImage
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteImage(
        UserIdVerificationImage $userIdVerificationImage
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $userIdVerificationImage->url
        );

        /**
         * Deleting thumbnail file from storage
         */
        $this->deleteImageThumbnailFile(
            $userIdVerificationImage->url
        );

        /**
         * Deleting user id verification image
         */
        return $this->userIdVerificationImageRepository->delete(
            $userIdVerificationImage
        );
    }

    /**
     * @param Collection $userIdVerificationImages
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteImages(
        Collection $userIdVerificationImages
    ) : bool
    {
        /** @var UserIdVerificationImage $userIdVerificationImage */
        foreach ($userIdVerificationImages as $userIdVerificationImage) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $userIdVerificationImage->url
            );

            /**
             * Deleting thumbnail file from storage
             */
            $this->deleteImageThumbnailFile(
                $userIdVerificationImage->url
            );
        }

        /**
         * Deleting user id verification images
         */
        return $this->userIdVerificationImageRepository->deleteByIds(
            $userIdVerificationImages->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
