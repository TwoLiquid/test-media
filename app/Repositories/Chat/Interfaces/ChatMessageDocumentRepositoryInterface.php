<?php

namespace App\Repositories\Chat\Interfaces;

use App\Models\MySql\Chat\ChatMessageDocument;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface ChatMessageDocumentRepositoryInterface
 *
 * @package App\Repositories\Chat\Interfaces
 */
interface ChatMessageDocumentRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return ChatMessageDocument|null
     */
    public function findById(
        int $id
    ) : ?ChatMessageDocument;

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
     * This method provides getting rows
     * with an eloquent model by certain query
     *
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
     * @param string $originalName
     * @param float $size
     * @param string $mime
     *
     * @return ChatMessageDocument|null
     */
    public function store(
        string $chatMessageId,
        string $url,
        string $originalName,
        float $size,
        string $mime
    ) : ?ChatMessageDocument;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param ChatMessageDocument $chatMessageDocument
     * @param string|null $chatMessageId
     * @param string|null $url
     * @param string|null $originalName
     * @param float|null $size
     * @param string|null $mime
     *
     * @return ChatMessageDocument
     */
    public function update(
        ChatMessageDocument $chatMessageDocument,
        ?string $chatMessageId,
        ?string $url,
        ?string $originalName,
        ?float $size,
        ?string $mime
    ) : ChatMessageDocument;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param ChatMessageDocument $chatMessageDocument
     *
     * @return bool
     */
    public function delete(
        ChatMessageDocument $chatMessageDocument
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
