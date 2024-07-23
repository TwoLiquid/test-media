<?php

namespace App\Services\File;

use App\Exceptions\BaseException;
use App\Services\File\Interfaces\FileServiceInterface;
use FFMpeg\FFProbe;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Pawlox\VideoThumbnail\VideoThumbnail;
use Exception;

/**
 * Class FileService
 *
 * @package App\Services\File
 */
abstract class FileService implements FileServiceInterface
{
    /**
     * @var string
     */
    protected const ENVIRONMENT = 'public';

    /**
     * @param string $content
     * @param string $extension
     * @param string $folder
     *
     * @return string
     *
     * @throws BaseException
     */
    public function uploadFile(
        string $content,
        string $extension,
        string $folder
    ) : string
    {
        try {

            /**
             * Generating file path
             */
            $filePath = implode('/', [
                $folder, implode('.', [
                    Str::uuid(), $extension
                ])
            ]);

            /**
             * Uploading file
             */
            Storage::disk($this::ENVIRONMENT)->put(
                $filePath,
                base64_decode($content)
            );

            return $filePath;
        } catch (Exception $exception) {
            throw new BaseException(
                trans('exceptions/service/file.' . __FUNCTION__),
                $exception->getMessage(),
                500
            );
        }
    }

    /**
     * @param string $filePath
     *
     * @return float
     */
    public function getFileDuration(
        string $filePath
    ) : float
    {

        $ffProbe = FFProbe::create([
            'ffmpeg.binaries'  => config('video-thumbnail.binaries.ffmpeg'),
            'ffprobe.binaries' => config('video-thumbnail.binaries.ffprobe')
        ]);

        return $ffProbe->format(
            Storage::disk($this::ENVIRONMENT)->path($filePath)
        )->get('duration');
    }

    /**
     * @param string $filePath
     *
     * @return int
     *
     * @throws BaseException
     */
    public function getFileSize(
        string $filePath
    ) : int
    {
        try {

            /**
             * Returning file size
             */
            return Storage::disk($this::ENVIRONMENT)->size(
                $filePath
            );
        } catch (Exception) {
            throw new BaseException(
                trans('exceptions/service/media/file.' . __FUNCTION__),
                null,
                500
            );
        }
    }

    /**
     * @param string $filePath
     *
     * @throws BaseException
     */
    public function createImageThumbnailFile(
        string $filePath
    ) : void
    {
        try {

            /**
             * Creating intervention image
             */
            $interventionImage = Image::make(
                file_get_contents(
                    Storage::disk($this::ENVIRONMENT)->path($filePath)
                )
            );

            /**
             * Resizing intervention image
             */
            $interventionImage->resize(150, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            /**
             * Creating image thumbnail
             */
            $interventionImage->save(
                Storage::disk($this::ENVIRONMENT)->path(
                    getMinimizedFilePath($filePath)
                )
            );
        } catch (Exception $exception) {
            throw new BaseException(
                trans('exceptions/service/file.' . __FUNCTION__),
                $exception->getMessage(),
                500
            );
        }
    }

    /**
     * @param string $filePath
     * @param string $folder
     *
     * @return string
     *
     * @throws BaseException
     */
    public function createVideoThumbnailFile(
        string $filePath,
        string $folder
    ) : string
    {
        /**
         * Creating video thumbnail file name
         */
        $thumbnailFileName = implode('.', [
            Str::uuid(),
            'jpg'
        ]);

        try {

            /**
             * Creating video thumbnail file
             */
            (new VideoThumbnail)->createThumbnail(
                Storage::disk($this::ENVIRONMENT)->path($filePath),
                Storage::disk($this::ENVIRONMENT)->path($folder),
                $thumbnailFileName,
                0
            );

            /**
             * Returning a video thumbnail file path
             */
            return implode('/', [
                $folder,
                $thumbnailFileName
            ]);
        } catch (Exception $exception) {
            throw new BaseException(
                trans('exceptions/service/video.' . __FUNCTION__),
                $exception->getMessage(),
                500
            );
        }
    }

    /**
     * @param string $filePath
     *
     * @return bool
     *
     * @throws BaseException
     */
    public function deleteFile(
        string $filePath
    ) : bool
    {
        try {

            /**
             * Deleting file
             */
            return Storage::disk($this::ENVIRONMENT)->delete(
                $filePath
            );
        } catch (Exception $exception) {
            throw new BaseException(
                trans('exceptions/service/file.' . __FUNCTION__),
                $exception->getMessage(),
                500
            );
        }
    }

    /**
     * @param string $filePath
     *
     * @return bool
     *
     * @throws BaseException
     */
    public function deleteImageThumbnailFile(
        string $filePath
    ) : bool
    {
        try {

            /**
             * Deleting minimized image file
             */
            return Storage::disk($this::ENVIRONMENT)->delete(
                getMinimizedFilePath($filePath)
            );
        } catch (Exception $exception) {
            throw new BaseException(
                trans('exceptions/service/file.' . __FUNCTION__),
                $exception->getMessage(),
                500
            );
        }
    }
}
