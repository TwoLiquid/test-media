<?php

namespace App\Repositories\Chat\Interfaces;

use App\Models\MySql\Chat\ChatMessageAudio;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface ChatMessageAudioRepositoryInterface
 *
 * @package App\Repositories\Chat\Interfaces
 */
interface ChatMessageAudioRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return ChatMessageAudio|null
     */
    public function findById(
        int $id
    ) : ?ChatMessageAudio;

    /**
     * This method provides getting all rows
     * with an eloquent model
     *
     * @return Collection
     */
    public function getAll() : Collection;

    /**
     * This method provides getting all rows
     * with an eloquent model with pagination
     *
     * @param int|null $page
     *
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(
        ?int $page
    ) : LengthAwarePaginator;

    /**
     * This method provides getting rows
     * with an eloquent model by certain query
     *
     * @param array $ids
     *
     * @return Collection
     */
    public function getByIds(
        array $ids
    ) : Collection;

    /**
     * @param string $chatMessageId
     *
     * @return Collection
     */
    public function getForChatMessage(
        string $chatMessageId
    ) : Collection;

    /**
     * This method provides getting rows
     * with an eloquent model by certain query
     *
     * @param array $chatMessagesIds
     *
     * @return Collection
     */
    public function getForChatMessages(
        array $chatMessagesIds
    ) : Collection;

    /**
     * This method provides getting rows
     * with an eloquent model by certain query
     *
     * @param string $chatMessageId
     * @param array $ids
     *
     * @return Collection
     */
    public function getForChatMessageByIds(
        string $chatMessageId,
        array $ids
    ) : Collection;

    /**
     * This method provides creating a new row
     * with an eloquent model
     *
     * @param string $chatMessageId
     * @param string $url
     * @param int $duration
     * @param float $size
     * @param string $mime
     *
     * @return ChatMessageAudio|null
     */
    public function store(
        string $chatMessageId,
        string $url,
        int $duration,
        float $size,
        string $mime
    ) : ?ChatMessageAudio;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param ChatMessageAudio $chatMessageAudio
     * @param string|null $chatMessageId
     * @param string|null $url
     * @param int|null $duration
     * @param float|null $size
     * @param string|null $mime
     *
     * @return ChatMessageAudio
     */
    public function update(
        ChatMessageAudio $chatMessageAudio,
        ?string $chatMessageId,
        ?string $url,
        ?int $duration,
        ?float $size,
        ?string $mime
    ) : ChatMessageAudio;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param ChatMessageAudio $chatMessageAudio
     *
     * @return bool
     */
    public function delete(
        ChatMessageAudio $chatMessageAudio
    ) : bool;

    /**
     * This method provides deleting existing rows
     * with an eloquent model
     *
     * @param array $ids
     *
     * @return bool
     */
    public function deleteByIds(
        array $ids
    ) : bool;
}
