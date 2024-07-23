<?php

namespace App\Services\Vybe;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\Vybe\VybeVideo;
use App\Repositories\Vybe\VybeVideoRepository;
use App\Repositories\Vybe\VybeVideoThumbnailRepository;
use App\Services\File\FileService;
use App\Services\Vybe\Interfaces\VybeVideoServiceInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class VybeVideoService
 *
 * @package App\Services\Vybe
 */
final class VybeVideoService extends FileService implements VybeVideoServiceInterface
{
    /**
     * Storage disk environment
     */
    protected const ENVIRONMENT = 'public';

    /**
     * Video files storage name
     */
    protected const FOLDER = 'vybe_videos';

    /**
     * Video thumbnail files storage name
     */
    protected const THUMBNAIL_FOLDER = 'vybe_video_thumbnails';

    /**
     * @var VybeVideoRepository
     */
    protected VybeVideoRepository $vybeVideoRepository;

    /**
     * @var VybeVideoThumbnailRepository
     */
    protected VybeVideoThumbnailRepository $vybeVideoThumbnailRepository;

    /**
     * VybeVideoService constructor
     */
    public function __construct()
    {
        /** @var VybeVideoRepository vybeVideoRepository */
        $this->vybeVideoRepository = new VybeVideoRepository();

        /** @var VybeVideoThumbnailRepository vybeVideoThumbnailRepository */
        $this->vybeVideoThumbnailRepository = new VybeVideoThumbnailRepository();
    }

    /**
     * @param string $content
     * @param string $mime
     * @param string $extension
     * @param bool $main
     *
     * @return VybeVideo
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createVideo(
        string $content,
        string $mime,
        string $extension,
        bool $main = false
    ) : VybeVideo
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
         * Creating vybe video
         */
        $vybeVideo = $this->vybeVideoRepository->store(
            $filePath,
            $duration,
            $mime,
            $main
        );

        /**
         * Checking vybe video existence
         */
        if ($vybeVideo) {

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
             * Creating vybe video thumbnail
             */
            $this->vybeVideoThumbnailRepository->store(
                $vybeVideo,
                $thumbnailFilePath,
                'image/jpg'
            );
        }

        return $vybeVideo;
    }

    /**
     * @param array $vybeVideoFiles
     *
     * @return Collection
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createVideos(
        array $vybeVideoFiles
    ) : Collection
    {
        /**
         * Preparing vybe videos collection
         */
        $vybeVideos = new Collection();

        /** @var array $vybeVideoFile */
        foreach ($vybeVideoFiles as $vybeVideoFile) {

            /**
             * Pushing created vybe video to response
             */
            $vybeVideos->push(
                $this->createVideo(
                    $vybeVideoFile['content'],
                    $vybeVideoFile['mime'],
                    $vybeVideoFile['extension'],
                    $vybeVideoFile['main'] ?? false
                )
            );
        }

        return $vybeVideos;
    }

    /**
     * @param Collection $vybeVideos
     *
     * @throws DatabaseException
     */
    public function acceptVideos(
        Collection $vybeVideos
    ) : void
    {
        /** @var VybeVideo $vybeVideo */
        foreach ($vybeVideos as $vybeVideo) {

            /**
             * Updating vybe video
             */
            $this->vybeVideoRepository->accept(
                $vybeVideo
            );
        }
    }

    /**
     * @param Collection $vybeVideos
     *
     * @throws DatabaseException
     */
    public function declineVideos(
        Collection $vybeVideos
    ) : void
    {
        /** @var VybeVideo $vybeVideo */
        foreach ($vybeVideos as $vybeVideo) {

            /**
             * Updating vybe video
             */
            $this->vybeVideoRepository->decline(
                $vybeVideo
            );
        }
    }

    /**
     * @param VybeVideo $vybeVideo
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteVideo(
        VybeVideo $vybeVideo
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $vybeVideo->url
        );

        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $vybeVideo->thumbnail->url
        );

        /**
         * Deleting minimized file from storage
         */
        $this->deleteFile(
            getMinimizedFilePath(
                $vybeVideo->thumbnail->url
            )
        );

        /**
         * Deleting vybe video thumbnail
         */
        $this->vybeVideoThumbnailRepository->delete(
            $vybeVideo->thumbnail
        );

        /**
         * Deleting vybe video
         */
        return $this->vybeVideoRepository->delete(
            $vybeVideo
        );
    }

    /**
     * @param Collection $vybeVideos
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteVideos(
        Collection $vybeVideos
    ) : bool
    {
        /** @var VybeVideo $vybeVideo */
        foreach ($vybeVideos as $vybeVideo) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $vybeVideo->url
            );

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $vybeVideo->thumbnail->url
            );

            /**
             * Deleting minimized file from storage
             */
            $this->deleteFile(
                getMinimizedFilePath(
                    $vybeVideo->thumbnail->url
                )
            );
        }

        /**
         * Deleting vybe video thumbnails
         */
        $this->vybeVideoThumbnailRepository->deleteByVideosIds(
            $vybeVideos->pluck('id')
                ->values()
                ->toArray()
        );

        /**
         * Deleting vybe videos
         */
        return $this->vybeVideoRepository->deleteByIds(
            $vybeVideos->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
