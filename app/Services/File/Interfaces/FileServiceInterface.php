<?php

namespace App\Services\File\Interfaces;

/**
 * Interface FileServiceInterface
 *
 * @package App\Services\File\Interfaces
 */
interface FileServiceInterface
{
    /**
     * This method provides creating data
     *
     * @param string $content
     * @param string $extension
     * @param string $folder
     *
     * @return string
     */
    public function uploadFile(
        string $content,
        string $extension,
        string $folder
    ) : string;

    /**
     * This method provides getting data
     *
     * @param string $filePath
     *
     * @return float
     */
    public function getFileDuration(
        string $filePath
    ) : float;

    /**
     * This method provides getting data
     *
     * @param string $filePath
     *
     * @return int
     */
    public function getFileSize(
        string $filePath
    ) : int;

    /**
     * This method provides creating data
     *
     * @param string $filePath
     */
    public function createImageThumbnailFile(
        string $filePath
    ) : void;

    /**
     * This method provides creating data
     *
     * @param string $filePath
     * @param string $folder
     *
     * @return string
     */
    public function createVideoThumbnailFile(
        string $filePath,
        string $folder
    ) : string;


    /**
     * This method provides deleting data
     *
     * @param string $filePath
     *
     * @return bool
     */
    public function deleteFile(
        string $filePath
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param string $filePath
     *
     * @return bool
     */
    public function deleteImageThumbnailFile(
        string $filePath
    ) : bool;
}
