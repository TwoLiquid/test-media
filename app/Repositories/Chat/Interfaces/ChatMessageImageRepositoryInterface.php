<?php

namespace App\Repositories\Chat\Interfaces;

use App\Models\MySql\Chat\ChatMessageImage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface ChatMessageImageRepositoryInterface
 *
 * @package App\Repositories\Chat\Interfaces
 */
interface ChatMessageImageRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return ChatMessageImage|null
     */
    public function findById(
        int $id
    ) : ?ChatMessageImage;

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
     * @param int $page
     *
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(
        int $page
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
     * with an eloquent models
     *
     * @param string $chatMessageId
     * @param string $url
     * @param float $size
     * @param string $mime
     *
     * @return ChatMessageImage|null
     */
    public function store(
        string $chatMessageId,
        string $url,
        float $size,
        string $mime
    ) : ?ChatMessageImage;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param ChatMessageImage $chatMessageImage
     * @param string|null $chatMessageId
     * @param string|null $url
     * @param float|null $size
     * @param string|null $mime
     *
     * @return ChatMessageImage
     */
    public function update(
        ChatMessageImage $chatMessageImage,
        ?string $chatMessageId,
        ?string $url,
        ?float $size,
        ?string $mime
    ) : ChatMessageImage;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param ChatMessageImage $chatMessageImage
     *
     * @return bool
     */
    public function delete(
        ChatMessageImage $chatMessageImage
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
