<?php

namespace App\Services\Support;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\Support\SupportTicketMessageAudio;
use App\Repositories\Support\SupportTicketMessageAudioRepository;
use App\Services\File\FileService;
use App\Services\Support\Interfaces\SupportTicketMessageAudioServiceInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class SupportTicketMessageAudioService
 *
 * @package App\Services\Support
 */
final class SupportTicketMessageAudioService extends FileService implements SupportTicketMessageAudioServiceInterface
{
    /**
     * Storage disk environment
     */
    protected const ENVIRONMENT = 'private';

    /**
     * Audio files storage name
     */
    protected const FOLDER = 'support_ticket_message_audios';

    /**
     * @var SupportTicketMessageAudioRepository
     */
    protected SupportTicketMessageAudioRepository $supportTicketMessageAudioRepository;

    /**
     * SupportTicketMessageAudioService constructor
     */
    public function __construct()
    {
        /** @var SupportTicketMessageAudioRepository supportTicketMessageAudioRepository */
        $this->supportTicketMessageAudioRepository = new SupportTicketMessageAudioRepository();
    }

    /**
     * @param string $messageId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return SupportTicketMessageAudio
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createAudio(
        string $messageId,
        string $content,
        string $mime,
        string $extension
    ) : SupportTicketMessageAudio
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
         * Creating support ticket message audio
         */
        return $this->supportTicketMessageAudioRepository->store(
            $messageId,
            $filePath,
            $duration,
            $size,
            $mime
        );
    }

    /**
     * @param string $messageId
     * @param array $audioFiles
     *
     * @return Collection
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createAudios(
        string $messageId,
        array $audioFiles
    ) : Collection
    {
        /**
         * Preparing a support ticket message audios collection
         */
        $supportTicketMessageAudios = new Collection();

        /** @var array $audioFile */
        foreach ($audioFiles as $audioFile) {

            /**
             * Pushing created support ticket message audio to response
             */
            $supportTicketMessageAudios->push(
                $this->createAudio(
                    $messageId,
                    $audioFile['content'],
                    $audioFile['mime'],
                    $audioFile['extension']
                )
            );
        }

        return $supportTicketMessageAudios;
    }

    /**
     * @param SupportTicketMessageAudio $supportTicketMessageAudio
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteAudio(
        SupportTicketMessageAudio $supportTicketMessageAudio
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $supportTicketMessageAudio->url
        );

        /**
         * Deleting support ticket message audio
         */
        return $this->supportTicketMessageAudioRepository->delete(
            $supportTicketMessageAudio
        );
    }

    /**
     * @param Collection $supportTicketMessageAudios
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteAudios(
        Collection $supportTicketMessageAudios
    ) : bool
    {
        /** @var SupportTicketMessageAudio $supportTicketMessageAudio */
        foreach ($supportTicketMessageAudios as $supportTicketMessageAudio) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $supportTicketMessageAudio->url
            );
        }

        /**
         * Deleting support ticket message audios
         */
        return $this->supportTicketMessageAudioRepository->deleteByIds(
            $supportTicketMessageAudios->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
