<?php

namespace App\Services\Chat;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\Chat\ChatMessageAudio;
use App\Repositories\Chat\ChatMessageAudioRepository;
use App\Services\Chat\Interfaces\ChatMessageAudioServiceInterface;
use App\Services\File\FileService;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ChatMessageAudioService
 *
 * @package App\Services\Chat
 */
final class ChatMessageAudioService extends FileService implements ChatMessageAudioServiceInterface
{
    /**
     * Storage disk environment
     */
    protected const ENVIRONMENT = 'private';

    /**
     * Audio files storage name
     */
    protected const FOLDER = 'chat_message_audios';

    /**
     * @var ChatMessageAudioRepository
     */
    protected ChatMessageAudioRepository $chatMessageAudioRepository;

    /**
     * ChatMessageAudioService constructor
     */
    public function __construct()
    {
        /** @var ChatMessageAudioRepository chatMessageAudioRepository */
        $this->chatMessageAudioRepository = new ChatMessageAudioRepository();
    }

    /**
     * @param string $chatMessageId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return ChatMessageAudio
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createAudio(
        string $chatMessageId,
        string $content,
        string $mime,
        string $extension
    ) : ChatMessageAudio
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
         * Creating chat message audio
         */
        return $this->chatMessageAudioRepository->store(
            $chatMessageId,
            $filePath,
            $duration,
            $size,
            $mime
        );
    }

    /**
     * @param string $chatMessageId
     * @param array $chatMessageAudioFiles
     *
     * @return Collection
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createAudios(
        string $chatMessageId,
        array $chatMessageAudioFiles
    ) : Collection
    {
        /**
         * Preparing chat message audios collection
         */
        $chatMessageAudios = new Collection();

        /** @var array $chatMessageAudioFile */
        foreach ($chatMessageAudioFiles as $chatMessageAudioFile) {

            /**
             * Pushing created chat message audio to response
             */
            $chatMessageAudios->push(
                $this->createAudio(
                    $chatMessageId,
                    $chatMessageAudioFile['content'],
                    $chatMessageAudioFile['mime'],
                    $chatMessageAudioFile['extension']
                )
            );
        }

        return $chatMessageAudios;
    }

    /**
     * @param ChatMessageAudio $chatMessageAudio
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteAudio(
        ChatMessageAudio $chatMessageAudio
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $chatMessageAudio->url
        );

        /**
         * Deleting chat message audio
         */
        return $this->chatMessageAudioRepository->delete(
            $chatMessageAudio
        );
    }

    /**
     * @param Collection $chatMessageAudios
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteAudios(
        Collection $chatMessageAudios
    ) : bool
    {
        /** @var ChatMessageAudio $chatMessageAudio */
        foreach ($chatMessageAudios as $chatMessageAudio) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $chatMessageAudio->url
            );
        }

        /**
         * Deleting chat message audios
         */
        return $this->chatMessageAudioRepository->deleteByIds(
            $chatMessageAudios->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
