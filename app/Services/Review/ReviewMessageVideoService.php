<?php

namespace App\Services\Review;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\Review\ReviewMessageVideo;
use App\Repositories\Review\ReviewMessageVideoRepository;
use App\Repositories\Review\ReviewMessageVideoThumbnailRepository;
use App\Services\File\FileService;
use App\Services\Review\Interfaces\ReviewMessageVideoServiceInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ReviewMessageVideoService
 *
 * @package App\Services\Review
 */
final class ReviewMessageVideoService extends FileService implements ReviewMessageVideoServiceInterface
{
    /**
     * Storage disk environment
     */
    protected const ENVIRONMENT = 'public';

    /**
     * Video files storage name
     */
    protected const FOLDER = 'review_message_videos';

    /**
     * Video thumbnail files storage name
     */
    protected const THUMBNAIL_FOLDER = 'review_message_video_thumbnails';

    /**
     * @var ReviewMessageVideoRepository
     */
    protected ReviewMessageVideoRepository $reviewMessageVideoRepository;

    /**
     * @var ReviewMessageVideoThumbnailRepository
     */
    protected ReviewMessageVideoThumbnailRepository $reviewMessageVideoThumbnailRepository;

    /**
     * ReviewMessageVideoService constructor
     */
    public function __construct()
    {
        /** @var ReviewMessageVideoRepository reviewMessageVideoRepository */
        $this->reviewMessageVideoRepository = new ReviewMessageVideoRepository();

        /** @var ReviewMessageVideoThumbnailRepository reviewMessageVideoThumbnailRepository */
        $this->reviewMessageVideoThumbnailRepository = new ReviewMessageVideoThumbnailRepository();
    }

    /**
     * @param string $messageId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return ReviewMessageVideo
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createVideo(
        string $messageId,
        string $content,
        string $mime,
        string $extension
    ) : ReviewMessageVideo
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
         * Getting file size
         */
        $size = $this->getFileSize(
            $filePath
        );

        /**
         * Creating review message video
         */
        $reviewMessageVideo = $this->reviewMessageVideoRepository->store(
            $messageId,
            $filePath,
            $duration,
            $size,
            $mime
        );

        /**
         * Checking review message video existence
         */
        if ($reviewMessageVideo) {

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
             * Creating review message video thumbnail
             */
            $this->reviewMessageVideoThumbnailRepository->store(
                $reviewMessageVideo,
                $thumbnailFilePath,
                'image/jpg'
            );
        }

        return $reviewMessageVideo;
    }

    /**
     * @param string $messageId
     * @param array $videoFiles
     *
     * @return Collection
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createVideos(
        string $messageId,
        array $videoFiles
    ) : Collection
    {
        /**
         * Preparing a review message video collection
         */
        $reviewMessageVideos = new Collection();

        /** @var array $videoFile */
        foreach ($videoFiles as $videoFile) {

            /**
             * Pushing created review message video to response
             */
            $reviewMessageVideos->push(
                $this->createVideo(
                    $messageId,
                    $videoFile['content'],
                    $videoFile['mime'],
                    $videoFile['extension']
                )
            );
        }

        return $reviewMessageVideos;
    }

    /**
     * @param ReviewMessageVideo $reviewMessageVideo
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteVideo(
        ReviewMessageVideo $reviewMessageVideo
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $reviewMessageVideo->url
        );

        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $reviewMessageVideo->thumbnail
                ->url
        );

        /**
         * Deleting minimized file from storage
         */
        $this->deleteFile(
            getMinimizedFilePath(
                $reviewMessageVideo->thumbnail->url
            )
        );

        /**
         * Deleting review message video thumbnail
         */
        $this->reviewMessageVideoThumbnailRepository->delete(
            $reviewMessageVideo->thumbnail
        );

        /**
         * Deleting review message video
         */
        return $this->reviewMessageVideoRepository->delete(
            $reviewMessageVideo
        );
    }

    /**
     * @param Collection $reviewMessageVideos
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteVideos(
        Collection $reviewMessageVideos
    ) : bool
    {
        /** @var ReviewMessageVideo $reviewMessageVideo */
        foreach ($reviewMessageVideos as $reviewMessageVideo) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $reviewMessageVideo->url
            );

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $reviewMessageVideo->thumbnail
                    ->url
            );

            /**
             * Deleting minimized file from storage
             */
            $this->deleteFile(
                getMinimizedFilePath(
                    $reviewMessageVideo->thumbnail->url
                )
            );
        }

        /**
         * Deleting review message video thumbnails
         */
        $this->reviewMessageVideoThumbnailRepository->deleteByVideosIds(
            $reviewMessageVideos->pluck('id')
                ->values()
                ->toArray()
        );

        /**
         * Deleting review message audios
         */
        return $this->reviewMessageVideoRepository->deleteByIds(
            $reviewMessageVideos->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
