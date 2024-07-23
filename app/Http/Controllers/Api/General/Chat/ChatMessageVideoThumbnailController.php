<?php

namespace App\Http\Controllers\Api\General\Chat;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\Chat\Interfaces\ChatMessageVideoThumbnailControllerInterface;
use App\Repositories\Chat\ChatMessageVideoThumbnailRepository;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class ChatMessageVideoThumbnailController
 *
 * @package App\Http\Controllers\Api\General\Chat
 */
final class ChatMessageVideoThumbnailController extends BaseController implements ChatMessageVideoThumbnailControllerInterface
{
    /**
     * @var ChatMessageVideoThumbnailRepository
     */
    protected ChatMessageVideoThumbnailRepository $chatMessageVideoThumbnailRepository;

    /**
     * ChatMessageVideoThumbnailController constructor
     */
    public function __construct()
    {
        /** @var ChatMessageVideoThumbnailRepository chatMessageVideoThumbnailRepository */
        $this->chatMessageVideoThumbnailRepository = new ChatMessageVideoThumbnailRepository();

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
         * Getting chat message video thumbnail
         */
        $chatMessageVideoThumbnail = $this->chatMessageVideoThumbnailRepository->findById($id);

        /**
         * Checking chat message video thumbnail existence
         */
        if (!$chatMessageVideoThumbnail) {
            throw new BaseException(
                trans('validations/api/general/chat/message/video/thumbnail/downloadFile.result.error'),
                null,
                400
            );
        }

        return $this->respondWithDownload(
            $chatMessageVideoThumbnail->url
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
         * Getting chat message video thumbnail
         */
        $chatMessageVideoThumbnail = $this->chatMessageVideoThumbnailRepository->findById($id);

        /**
         * Checking chat message video thumbnail existence
         */
        if (!$chatMessageVideoThumbnail) {
            throw new BaseException(
                trans('validations/api/general/chat/message/video/thumbnail/downloadMinFile.result.error'),
                null,
                400
            );
        }

        return $this->respondWithDownload(
            getMinimizedFilePath(
                $chatMessageVideoThumbnail->url
            )
        );
    }
}
