<?php

namespace App\Http\Controllers\Api\General\Support\Ticket;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\Support\Ticket\Interfaces\SupportTicketMessageVideoThumbnailControllerInterface;
use App\Repositories\Support\SupportTicketMessageVideoThumbnailRepository;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class SupportTicketMessageVideoThumbnailController
 *
 * @package App\Http\Controllers\Api\General\Support\Ticket
 */
final class SupportTicketMessageVideoThumbnailController extends BaseController implements SupportTicketMessageVideoThumbnailControllerInterface
{
    /**
     * @var SupportTicketMessageVideoThumbnailRepository
     */
    protected SupportTicketMessageVideoThumbnailRepository $supportTicketMessageVideoThumbnailRepository;

    /**
     * SupportTicketMessageVideoThumbnailController constructor
     */
    public function __construct()
    {
        /** @var SupportTicketMessageVideoThumbnailRepository supportTicketMessageVideoThumbnailRepository */
        $this->supportTicketMessageVideoThumbnailRepository = new SupportTicketMessageVideoThumbnailRepository();

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
         * Getting support ticket message video thumbnail
         */
        $supportTicketMessageVideoThumbnail = $this->supportTicketMessageVideoThumbnailRepository->findById($id);

        /**
         * Checking support ticket message video thumbnail existence
         */
        if (!$supportTicketMessageVideoThumbnail) {
            throw new BaseException(
                trans('validations/api/general/support/ticket/message/video/thumbnail/downloadFile.result.error'),
                null,
                400
            );
        }

        return $this->respondWithDownload(
            $supportTicketMessageVideoThumbnail->url
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
         * Getting support ticket message video thumbnail
         */
        $supportTicketMessageVideoThumbnail = $this->supportTicketMessageVideoThumbnailRepository->findById($id);

        /**
         * Checking support ticket message video thumbnail existence
         */
        if (!$supportTicketMessageVideoThumbnail) {
            throw new BaseException(
                trans('validations/api/general/support/ticket/message/video/thumbnail/downloadMinFile.result.error'),
                null,
                400
            );
        }

        return $this->respondWithDownload(
            getMinimizedFilePath(
                $supportTicketMessageVideoThumbnail->url
            )
        );
    }
}
