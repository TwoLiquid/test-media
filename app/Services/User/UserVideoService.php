<?php

namespace App\Services\User;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\User\UserVideo;
use App\Repositories\User\UserVideoRepository;
use App\Repositories\User\UserVideoThumbnailRepository;
use App\Services\File\FileService;
use App\Services\User\Interfaces\UserVideoServiceInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class UserVideoService
 *
 * @package App\Services\User
 */
final class UserVideoService extends FileService implements UserVideoServiceInterface
{
    /**
     * @var string
     */
    protected const ENVIRONMENT = 'public';

    /**
     * Image files storage name
     */
    protected const FOLDER = 'user_videos';

    /**
     * Video thumbnail files storage name
     */
    protected const THUMBNAIL_FOLDER = 'user_video_thumbnails';

    /**
     * @var UserVideoRepository
     */
    protected UserVideoRepository $userVideoRepository;

    /**
     * @var UserVideoThumbnailRepository
     */
    protected UserVideoThumbnailRepository $userVideoThumbnailRepository;

    /**
     * UserVideoService constructor
     */
    public function __construct()
    {
        /** @var UserVideoRepository userVideoRepository */
        $this->userVideoRepository = new UserVideoRepository();

        /** @var UserVideoThumbnailRepository userVideoThumbnailRepository */
        $this->userVideoThumbnailRepository = new UserVideoThumbnailRepository();
    }

    /**
     * @param int $authId
     * @param string $content
     * @param string $mime
     * @param string $extension
     * @param string|null $requestId
     *
     * @return UserVideo
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createVideo(
        int $authId,
        string $content,
        string $mime,
        string $extension,
        ?string $requestId = null
    ) : UserVideo
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
         * Creating user video
         */
        $userVideo = $this->userVideoRepository->store(
            $authId,
            $requestId,
            $filePath,
            $duration,
            $mime
        );

        /**
         * Checking user video existence
         */
        if ($userVideo) {

            /**
             * Creating video thumbnail file
             */
            $thumbnailFilePath = $this->createVideoThumbnailFile(
                $filePath,
                self::THUMBNAIL_FOLDER
            );

            /**
             * Creating minimized video thumbnail
             */
            $this->createImageThumbnailFile(
                $thumbnailFilePath
            );

            /**
             * Creating user video thumbnail
             */
            $this->userVideoThumbnailRepository->store(
                $userVideo,
                $thumbnailFilePath,
                'image/jpg'
            );
        }

        return $userVideo;
    }

    /**
     * @param int $authId
     * @param array $userVideoFiles
     *
     * @return Collection
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createVideos(
        int $authId,
        array $userVideoFiles
    ) : Collection
    {
        /**
         * Preparing user videos collection
         */
        $userVideos = new Collection();

        /** @var array $userVideoFile */
        foreach ($userVideoFiles as $userVideoFile) {

            /**
             * Pushing created user video to response
             */
            $userVideos->push(
                $this->createVideo(
                    $authId,
                    $userVideoFile['content'],
                    $userVideoFile['mime'],
                    $userVideoFile['extension'],
                    $userVideoFile['request_id'] ?? null
                )
            );
        }

        return $userVideos;
    }

    /**
     * @param UserVideo $userVideo
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteVideo(
        UserVideo $userVideo
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $userVideo->url
        );

        /**
         * Deleting thumbnail file from storage
         */
        $this->deleteImageThumbnailFile(
            $userVideo->url
        );

        /**
         * Deleting user video
         */
        return $this->userVideoRepository->delete(
            $userVideo
        );
    }

    /**
     * @param Collection $userVideos
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteVideos(
        Collection $userVideos
    ) : bool
    {
        /** @var UserVideo $userVideo */
        foreach ($userVideos as $userVideo) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $userVideo->url
            );

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $userVideo->thumbnail->url
            );

            /**
             * Deleting minimized file from storage
             */
            $this->deleteFile(
                getMinimizedFilePath(
                    $userVideo->thumbnail->url
                )
            );
        }

        /**
         * Deleting user video thumbnails
         */
        $this->userVideoThumbnailRepository->deleteByVideosIds(
            $userVideos->pluck('id')
                ->values()
                ->toArray()
        );

        /**
         * Deleting user videos
         */
        return $this->userVideoRepository->deleteByIds(
            $userVideos->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
