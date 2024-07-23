<?php

namespace App\Services\Support\Interfaces;

use App\Models\MySql\Support\SupportTicketMessageAudio;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface SupportTicketMessageAudioServiceInterface
 *
 * @package App\Services\Support\Interfaces
 */
interface SupportTicketMessageAudioServiceInterface
{
    /**
     * This method provides creating data
     *
     * @param string $messageId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return SupportTicketMessageAudio
     */
    public function createAudio(
        string $messageId,
        string $content,
        string $mime,
        string $extension
    ) : SupportTicketMessageAudio;

    /**
     * This method provides creating data
     *
     * @param string $messageId
     * @param array $audioFiles
     *
     * @return Collection
     */
    public function createAudios(
        string $messageId,
        array $audioFiles
    ) : Collection;

    /**
     * This method provides deleting data
     *
     * @param SupportTicketMessageAudio $supportTicketMessageAudio
     *
     * @return bool
     */
    public function deleteAudio(
        SupportTicketMessageAudio $supportTicketMessageAudio
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $supportTicketMessageAudios
     *
     * @return bool
     */
    public function deleteAudios(
        Collection $supportTicketMessageAudios
    ) : bool;
}
