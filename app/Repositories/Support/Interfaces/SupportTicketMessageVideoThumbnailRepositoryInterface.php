<?php

namespace App\Repositories\Support\Interfaces;

use App\Models\MySql\Support\SupportTicketMessageVideo;
use App\Models\MySql\Support\SupportTicketMessageVideoThumbnail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface SupportTicketMessageVideoThumbnailRepositoryInterface
 *
 * @package App\Repositories\Support\Interfaces
 */
interface SupportTicketMessageVideoThumbnailRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return SupportTicketMessageVideoThumbnail|null
     */
    public function findById(
        int $id
    ) : ?SupportTicketMessageVideoThumbnail;

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
     * This method provides creating a new row
     * with an eloquent models
     *
     * @param SupportTicketMessageVideo $supportTicketMessageVideo
     * @param string $url
     * @param string $mime
     *
     * @return SupportTicketMessageVideoThumbnail|null
     */
    public function store(
        SupportTicketMessageVideo $supportTicketMessageVideo,
        string $url,
        string $mime
    ) : ?SupportTicketMessageVideoThumbnail;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param SupportTicketMessageVideoThumbnail $supportTicketMessageVideoThumbnail
     * @param SupportTicketMessageVideo|null $supportTicketMessageVideo
     * @param string|null $url
     * @param string|null $mime
     *
     * @return SupportTicketMessageVideoThumbnail
     */
    public function update(
        SupportTicketMessageVideoThumbnail $supportTicketMessageVideoThumbnail,
        ?SupportTicketMessageVideo $supportTicketMessageVideo,
        ?string $url,
        ?string $mime
    ) : SupportTicketMessageVideoThumbnail;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param SupportTicketMessageVideoThumbnail $supportTicketMessageVideoThumbnail
     *
     * @return bool
     */
    public function delete(
        SupportTicketMessageVideoThumbnail $supportTicketMessageVideoThumbnail
    ) : bool;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param array $videosIds
     *
     * @return bool
     */
    public function deleteByVideosIds(
        array $videosIds
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
