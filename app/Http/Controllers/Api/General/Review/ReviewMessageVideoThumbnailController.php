<?php

namespace App\Http\Controllers\Api\General\Review;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\Review\Interfaces\ReviewMessageVideoThumbnailControllerInterface;
use App\Repositories\Review\ReviewMessageVideoThumbnailRepository;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class ReviewMessageVideoThumbnailController
 *
 * @package App\Http\Controllers\Api\General\Review
 */
final class ReviewMessageVideoThumbnailController extends BaseController implements ReviewMessageVideoThumbnailControllerInterface
{
    /**
     * @var ReviewMessageVideoThumbnailRepository
     */
    protected ReviewMessageVideoThumbnailRepository $reviewMessageVideoThumbnailRepository;

    /**
     * ReviewMessageVideoThumbnailController constructor
     */
    public function __construct()
    {
        /** @var ReviewMessageVideoThumbnailRepository reviewMessageVideoThumbnailRepository */
        $this->reviewMessageVideoThumbnailRepository = new ReviewMessageVideoThumbnailRepository();

        parent::__construct();
    }

    /**
     * @param int $id
     *
     * @return BinaryFileResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function downloadFile(
        int $id
    ) : BinaryFileResponse
    {
        /**
         * Getting review message video thumbnail
         */
        $reviewMessageVideoThumbnail = $this->reviewMessageVideoThumbnailRepository->findById($id);

        /**
         * Checking review message video thumbnail existence
         */
        if (!$reviewMessageVideoThumbnail) {
            throw new BaseException(
                trans('validations/api/general/review/message/video/thumbnail/downloadFile.result.error'),
                null,
                400
            );
        }

        return $this->respondWithDownload(
            $reviewMessageVideoThumbnail->url
        );
    }

    /**
     * @param int $id
     *
     * @return BinaryFileResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function downloadMinFile(
        int $id
    ) : BinaryFileResponse
    {
        /**
         * Getting review message video thumbnail
         */
        $reviewMessageVideoThumbnail = $this->reviewMessageVideoThumbnailRepository->findById($id);

        /**
         * Checking review message video thumbnail existence
         */
        if (!$reviewMessageVideoThumbnail) {
            throw new BaseException(
                trans('validations/api/general/review/message/video/thumbnail/downloadMinFile.result.error'),
                null,
                400
            );
        }

        return $this->respondWithDownload(
            getMinimizedFilePath(
                $reviewMessageVideoThumbnail->url
            )
        );
    }
}
