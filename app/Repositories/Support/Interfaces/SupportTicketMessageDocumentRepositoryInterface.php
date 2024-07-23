<?php

namespace App\Repositories\Support\Interfaces;

use App\Models\MySql\Support\SupportTicketMessageDocument;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface SupportTicketMessageDocumentRepositoryInterface
 *
 * @package App\Repositories\Support\Interfaces
 */
interface SupportTicketMessageDocumentRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return SupportTicketMessageDocument|null
     */
    public function findById(
        int $id
    ) : ?SupportTicketMessageDocument;

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
     * with an eloquent model
     *
     * @param string $messageId
     * @param string $url
     * @param string $originalName
     * @param float $size
     * @param string $mime
     *
     * @return SupportTicketMessageDocument|null
     */
    public function store(
        string $messageId,
        string $url,
        string $originalName,
        float $size,
        string $mime
    ) : ?SupportTicketMessageDocument;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param SupportTicketMessageDocument $supportTicketMessageDocument
     * @param string|null $messageId
     * @param string|null $url
     * @param string|null $originalName
     * @param float|null $size
     * @param string|null $mime
     *
     * @return SupportTicketMessageDocument
     */
    public function update(
        SupportTicketMessageDocument $supportTicketMessageDocument,
        ?string $messageId,
        ?string $url,
        ?string $originalName,
        ?float $size,
        ?string $mime
    ) : SupportTicketMessageDocument;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param SupportTicketMessageDocument $supportTicketMessageDocument
     *
     * @return bool
     */
    public function delete(
        SupportTicketMessageDocument $supportTicketMessageDocument
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
