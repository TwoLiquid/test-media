<?php

namespace App\Repositories\Support\Interfaces;

use App\Models\MySql\Support\SupportTicketMessageVideo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface SupportTicketMessageVideoRepositoryInterface
 *
 * @package App\Repositories\Support\Interfaces
 */
interface SupportTicketMessageVideoRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return SupportTicketMessageVideo|null
     */
    public function findById(
        int $id
    ) : ?SupportTicketMessageVideo;

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
     * @param string $messageId
     *
     * @return Collection
     */
    public function getForMessage(
        string $messageId
    ) : Collection;

    /**
     * This method provides getting rows
     * with an eloquent model by certain query
     *
     * @param array $messagesIds
     *
     * @return Collection
     */
    public function getForMessages(
        array $messagesIds
    ) : Collection;

    /**
     * This method provides getting rows
     * with an eloquent model by certain query
     *
     * @param string $messageId
     * @param array $ids
     *
     * @return Collection
     */
    public function getForMessageByIds(
        string $messageId,
        array $ids
    ) : Collection;

    /**
     * This method provides creating a new row
     * with an eloquent models
     *
     * @param string $messageId
     * @param string $url
     * @param int $duration
     * @param float $size
     * @param string $mime
     *
     * @return SupportTicketMessageVideo|null
     */
    public function store(
        string $messageId,
        string $url,
        int $duration,
        float $size,
        string $mime
    ) : ?SupportTicketMessageVideo;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param SupportTicketMessageVideo $supportTicketMessageVideo
     * @param string|null $chatMessageId
     * @param string|null $url
     * @param int|null $duration
     * @param float|null $size
     * @param string|null $mime
     *
     * @return SupportTicketMessageVideo
     */
    public function update(
        SupportTicketMessageVideo $supportTicketMessageVideo,
        ?string $chatMessageId,
        ?string $url,
        ?int $duration,
        ?float $size,
        ?string $mime
    ) : SupportTicketMessageVideo;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param SupportTicketMessageVideo $supportTicketMessageVideo
     *
     * @return bool
     */
    public function delete(
        SupportTicketMessageVideo $supportTicketMessageVideo
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
