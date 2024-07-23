<?php

namespace App\Services\Chat\Interfaces;

use App\Models\MySql\Chat\ChatMessageAudio;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface ChatMessageAudioServiceInterface
 *
 * @package App\Services\Chat\Interfaces
 */
interface ChatMessageAudioServiceInterface
{
    /**
     * This method provides creating data
     *
     * @param string $chatMessageId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return ChatMessageAudio
     */
    public function createAudio(
        string $chatMessageId,
        string $content,
        string $mime,
        string $extension
    ) : ChatMessageAudio;

    /**
     * This method provides creating data
     *
     * @param string $chatMessageId
     * @param array $chatMessageAudioFiles
     *
     * @return Collection
     */
    public function createAudios(
        string $chatMessageId,
        array $chatMessageAudioFiles
    ) : Collection;

    /**
     * This method provides deleting data
     *
     * @param ChatMessageAudio $chatMessageAudio
     *
     * @return bool
     */
    public function deleteAudio(
        ChatMessageAudio $chatMessageAudio
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $chatMessageAudios
     *
     * @return bool
     */
    public function deleteAudios(
        Collection $chatMessageAudios
    ) : bool;
}
