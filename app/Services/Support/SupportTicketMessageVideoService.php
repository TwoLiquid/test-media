<?php

namespace App\Services\Support;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\Support\SupportTicketMessageVideo;
use App\Repositories\Support\SupportTicketMessageVideoRepository;
use App\Repositories\Support\SupportTicketMessageVideoThumbnailRepository;
use App\Services\File\FileService;
use App\Services\Support\Interfaces\SupportTicketMessageVideoServiceInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class SupportTicketMessageVideoService
 *
 * @package App\Services\Support
 */
final class SupportTicketMessageVideoService extends FileService implements SupportTicketMessageVideoServiceInterface
{
    /**
     * Storage disk environment
     */
    protected const ENVIRONMENT = 'private';

    /**
     * Video files storage name
     */
    protected const FOLDER = 'support_ticket_message_videos';

    /**
     * Video thumbnail files storage name
     */
    protected const THUMBNAIL_FOLDER = 'support_ticket_message_video_thumbnails';

    /**
     * @var SupportTicketMessageVideoRepository
     */
    protected SupportTicketMessageVideoRepository $supportTicketMessageVideoRepository;

    /**
     * @var SupportTicketMessageVideoThumbnailRepository
     */
    protected SupportTicketMessageVideoThumbnailRepository $supportTicketMessageVideoThumbnailRepository;

    /**
     * SupportTicketMessageVideoService constructor
     */
    public function __construct()
    {
        /** @var SupportTicketMessageVideoRepository supportTicketMessageVideoRepository */
        $this->supportTicketMessageVideoRepository = new SupportTicketMessageVideoRepository();

        /** @var SupportTicketMessageVideoThumbnailRepository supportTicketMessageVideoThumbnailRepository */
        $this->supportTicketMessageVideoThumbnailRepository = new SupportTicketMessageVideoThumbnailRepository();
    }

    /**
     * @param string $messageId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return SupportTicketMessageVideo
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createVideo(
        string $messageId,
        string $content,
        string $mime,
        string $extension
    ) : SupportTicketMessageVideo
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
         * Creating support ticket message video
         */
        $supportTicketMessageVideo = $this->supportTicketMessageVideoRepository->store(
            $messageId,
            $filePath,
            $duration,
            $size,
            $mime
        );

        /**
         * Checking support ticket message video existence
         */
        if ($supportTicketMessageVideo) {

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
             * Creating support ticket message video thumbnail
             */
            $this->supportTicketMessageVideoThumbnailRepository->store(
                $supportTicketMessageVideo,
                $thumbnailFilePath,
                'image/jpg'
            );
        }

        return $supportTicketMessageVideo;
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
         * Preparing a support ticket message video collection
         */
        $supportTicketMessageVideos = new Collection();

        /** @var array $videoFile */
        foreach ($videoFiles as $videoFile) {

            /**
             * Pushing created support ticket message video to response
             */
            $supportTicketMessageVideos->push(
                $this->createVideo(
                    $messageId,
                    $videoFile['content'],
                    $videoFile['mime'],
                    $videoFile['extension']
                )
            );
        }

        return $supportTicketMessageVideos;
    }

    /**
     * @param SupportTicketMessageVideo $supportTicketMessageVideo
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteVideo(
        SupportTicketMessageVideo $supportTicketMessageVideo
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $supportTicketMessageVideo->url
        );

        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $supportTicketMessageVideo->thumbnail
                ->url
        );

        /**
         * Deleting minimized file from storage
         */
        $this->deleteFile(
            getMinimizedFilePath(
                $supportTicketMessageVideo->thumbnail->url
            )
        );

        /**
         * Deleting support ticket message video thumbnail
         */
        $this->supportTicketMessageVideoThumbnailRepository->delete(
            $supportTicketMessageVideo->thumbnail
        );

        /**
         * Deleting support ticket message video
         */
        return $this->supportTicketMessageVideoRepository->delete(
            $supportTicketMessageVideo
        );
    }

    /**
     * @param Collection $supportTicketMessageVideos
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteVideos(
        Collection $supportTicketMessageVideos
    ) : bool
    {
        /** @var SupportTicketMessageVideo $supportTicketMessageVideo */
        foreach ($supportTicketMessageVideos as $supportTicketMessageVideo) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $supportTicketMessageVideo->url
            );

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $supportTicketMessageVideo->thumbnail
                    ->url
            );

            /**
             * Deleting minimized file from storage
             */
            $this->deleteFile(
                getMinimizedFilePath(
                    $supportTicketMessageVideo->thumbnail->url
                )
            );
        }

        /**
         * Deleting support ticket message video thumbnails
         */
        $this->supportTicketMessageVideoThumbnailRepository->deleteByVideosIds(
            $supportTicketMessageVideos->pluck('id')
                ->values()
                ->toArray()
        );

        /**
         * Deleting support ticket message audios
         */
        return $this->supportTicketMessageVideoRepository->deleteByIds(
            $supportTicketMessageVideos->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
