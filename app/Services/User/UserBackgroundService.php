<?php

namespace App\Services\User;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\User\UserBackground;
use App\Repositories\User\UserBackgroundRepository;
use App\Services\File\FileService;
use App\Services\User\Interfaces\UserBackgroundServiceInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class UserBackgroundService
 *
 * @package App\Services\User
 */
final class UserBackgroundService extends FileService implements UserBackgroundServiceInterface
{
    /**
     * @var string
     */
    protected const ENVIRONMENT = 'public';

    /**
     * Image files storage name
     */
    protected const FOLDER = 'user_backgrounds';

    /**
     * @var UserBackgroundRepository
     */
    protected UserBackgroundRepository $userBackgroundRepository;

    /**
     * UserBackgroundService constructor
     */
    public function __construct()
    {
        /** @var UserBackgroundRepository userBackgroundRepository */
        $this->userBackgroundRepository = new UserBackgroundRepository();
    }

    /**
     * @param int $authId
     * @param string $content
     * @param string $mime
     * @param string $extension
     * @param string|null $requestId
     *
     * @return UserBackground
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
    ) : UserBackground
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
         * Creating a user background
         */
        return $this->userBackgroundRepository->store(
            $authId,
            $requestId,
            $filePath,
            $mime
        );
    }

    /**
     * @param int $authId
     * @param array $userBackgroundFiles
     *
     * @return Collection
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createImages(
        int $authId,
        array $userBackgroundFiles
    ) : Collection
    {
        /**
         * Preparing a user backgrounds collection
         */
        $userBackgrounds = new Collection();

        /** @var array $userBackgroundFile */
        foreach ($userBackgroundFiles as $userBackgroundFile) {

            /**
             * Pushing created user backgrounds to response
             */
            $userBackgrounds->push(
                $this->createImage(
                    $authId,
                    $userBackgroundFile['content'],
                    $userBackgroundFile['mime'],
                    $userBackgroundFile['extension']
                )
            );
        }

        return $userBackgrounds;
    }

    /**
     * @param UserBackground $userBackground
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteImage(
        UserBackground $userBackground
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $userBackground->url
        );

        /**
         * Deleting thumbnail file from storage
         */
        $this->deleteImageThumbnailFile(
            $userBackground->url
        );

        /**
         * Deleting user background
         */
        return $this->userBackgroundRepository->delete(
            $userBackground
        );
    }

    /**
     * @param Collection $userBackgrounds
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteImages(
        Collection $userBackgrounds
    ) : bool
    {
        /** @var UserBackground $userBackground */
        foreach ($userBackgrounds as $userBackground) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $userBackground->url
            );

            /**
             * Deleting thumbnail file from storage
             */
            $this->deleteImageThumbnailFile(
                $userBackground->url
            );
        }

        /**
         * Deleting user backgrounds
         */
        return $this->userBackgroundRepository->deleteByIds(
            $userBackgrounds->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
