<?php

namespace App\Repositories\Support\Interfaces;

use App\Models\MySql\Support\SupportTicketMessageImage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface SupportTicketMessageImageRepositoryInterface
 *
 * @package App\Repositories\Support\Interfaces
 */
interface SupportTicketMessageImageRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return SupportTicketMessageImage|null
     */
    public function findById(
        int $id
    ) : ?SupportTicketMessageImage;

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
     * @param float $size
     * @param string $mime
     *
     * @return SupportTicketMessageImage|null
     */
    public function store(
        string $messageId,
        string $url,
        float $size,
        string $mime
    ) : ?SupportTicketMessageImage;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param SupportTicketMessageImage $supportTicketMessageImage
     * @param string|null $chatMessageId
     * @param string|null $url
     * @param float|null $size
     * @param string|null $mime
     *
     * @return SupportTicketMessageImage
     */
    public function update(
        SupportTicketMessageImage $supportTicketMessageImage,
        ?string $chatMessageId,
        ?string $url,
        ?float $size,
        ?string $mime
    ) : SupportTicketMessageImage;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param SupportTicketMessageImage $supportTicketMessageImage
     *
     * @return bool
     */
    public function delete(
        SupportTicketMessageImage $supportTicketMessageImage
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
