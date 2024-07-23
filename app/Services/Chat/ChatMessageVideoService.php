<?php

namespace App\Services\Chat;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\Chat\ChatMessageVideo;
use App\Repositories\Chat\ChatMessageVideoRepository;
use App\Repositories\Chat\ChatMessageVideoThumbnailRepository;
use App\Services\Chat\Interfaces\ChatMessageVideoServiceInterface;
use App\Services\File\FileService;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ChatMessageVideoService
 *
 * @package App\Services\Chat
 */
final class ChatMessageVideoService extends FileService implements ChatMessageVideoServiceInterface
{
    /**
     * Storage disk environment
     */
    protected const ENVIRONMENT = 'private';

    /**
     * Video files storage name
     */
    protected const FOLDER = 'chat_message_videos';

    /**
     * Video thumbnail files storage name
     */
    protected const THUMBNAIL_FOLDER = 'chat_message_video_thumbnails';

    /**
     * @var ChatMessageVideoRepository
     */
    protected ChatMessageVideoRepository $chatMessageVideoRepository;

    /**
     * @var ChatMessageVideoThumbnailRepository
     */
    protected ChatMessageVideoThumbnailRepository $chatMessageVideoThumbnailRepository;

    /**
     * ChatMessageVideoService constructor
     */
    public function __construct()
    {
        /** @var ChatMessageVideoRepository chatMessageVideoRepository */
        $this->chatMessageVideoRepository = new ChatMessageVideoRepository();

        /** @var ChatMessageVideoThumbnailRepository chatMessageVideoThumbnailRepository */
        $this->chatMessageVideoThumbnailRepository = new ChatMessageVideoThumbnailRepository();
    }

    /**
     * @param string $chatMessageId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return ChatMessageVideo
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createVideo(
        string $chatMessageId,
        string $content,
        string $mime,
        string $extension
    ) : ChatMessageVideo
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
         * Creating chat message video
         */
        $chatMessageVideo = $this->chatMessageVideoRepository->store(
            $chatMessageId,
            $filePath,
            $duration,
            $size,
            $mime
        );

        /**
         * Checking chat message video existence
         */
        if ($chatMessageVideo) {

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
             * Creating chat message video thumbnail
             */
            $this->chatMessageVideoThumbnailRepository->store(
                $chatMessageVideo,
                $thumbnailFilePath,
                'image/jpg'
            );
        }

        return $chatMessageVideo;
    }

    /**
     * @param string $chatMessageId
     * @param array $chatMessageVideoFiles
     *
     * @return Collection
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createVideos(
        string $chatMessageId,
        array $chatMessageVideoFiles
    ) : Collection
    {
        /**
         * Preparing a chat message video collection
         */
        $chatMessageVideos = new Collection();

        /** @var array $chatMessageVideoFile */
        foreach ($chatMessageVideoFiles as $chatMessageVideoFile) {

            /**
             * Pushing created chat message video to response
             */
            $chatMessageVideos->push(
                $this->createVideo(
                    $chatMessageId,
                    $chatMessageVideoFile['content'],
                    $chatMessageVideoFile['mime'],
                    $chatMessageVideoFile['extension']
                )
            );
        }

        return $chatMessageVideos;
    }

    /**
     * @param ChatMessageVideo $chatMessageVideo
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteVideo(
        ChatMessageVideo $chatMessageVideo
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $chatMessageVideo->url
        );

        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $chatMessageVideo->thumbnail
                ->url
        );

        /**
         * Deleting minimized file from storage
         */
        $this->deleteFile(
            getMinimizedFilePath(
                $chatMessageVideo->thumbnail->url
            )
        );

        /**
         * Deleting chat message video thumbnail
         */
        $this->chatMessageVideoThumbnailRepository->delete(
            $chatMessageVideo->thumbnail
        );

        /**
         * Deleting chat message video
         */
        return $this->chatMessageVideoRepository->delete(
            $chatMessageVideo
        );
    }

    /**
     * @param Collection $chatMessageVideos
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteVideos(
        Collection $chatMessageVideos
    ) : bool
    {
        /** @var ChatMessageVideo $chatMessageVideo */
        foreach ($chatMessageVideos as $chatMessageVideo) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $chatMessageVideo->url
            );

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $chatMessageVideo->thumbnail
                    ->url
            );

            /**
             * Deleting minimized file from storage
             */
            $this->deleteFile(
                getMinimizedFilePath(
                    $chatMessageVideo->thumbnail->url
                )
            );
        }

        /**
         * Deleting chat message video thumbnails
         */
        $this->chatMessageVideoThumbnailRepository->deleteByVideosIds(
            $chatMessageVideos->pluck('id')
                ->values()
                ->toArray()
        );

        /**
         * Deleting chat message audios
         */
        return $this->chatMessageVideoRepository->deleteByIds(
            $chatMessageVideos->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
