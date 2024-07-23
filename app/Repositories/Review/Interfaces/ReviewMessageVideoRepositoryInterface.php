<?php

namespace App\Repositories\Review\Interfaces;

use App\Models\MySql\Review\ReviewMessageVideo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface ReviewMessageVideoRepositoryInterface
 *
 * @package App\Repositories\Review\Interfaces
 */
interface ReviewMessageVideoRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return ReviewMessageVideo|null
     */
    public function findById(
        int $id
    ) : ?ReviewMessageVideo;

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
     * @param array|null $ids
     *
     * @return Collection
     */
    public function getByIds(
        ?array $ids
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
     * @param int $duration
     * @param float $size
     * @param string $mime
     *
     * @return ReviewMessageVideo|null
     */
    public function store(
        string $messageId,
        string $url,
        int $duration,
        float $size,
        string $mime
    ) : ?ReviewMessageVideo;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param ReviewMessageVideo $reviewMessageVideo
     * @param string|null $messageId
     * @param string|null $url
     * @param int|null $duration
     * @param float|null $size
     * @param string|null $mime
     *
     * @return ReviewMessageVideo
     */
    public function update(
        ReviewMessageVideo $reviewMessageVideo,
        ?string $messageId,
        ?string $url,
        ?int $duration,
        ?float $size,
        ?string $mime
    ) : ReviewMessageVideo;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param ReviewMessageVideo $reviewMessageVideo
     *
     * @return bool|null
     */
    public function delete(
        ReviewMessageVideo $reviewMessageVideo
    ) : ?bool;

    /**
     * This method provides deleting existing rows
     * with an eloquent model
     *
     * @param array $ids
     *
     * @return bool|null
     */
    public function deleteByIds(
        array $ids
    ) : ?bool;
}
