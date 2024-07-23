<?php

namespace App\Repositories\Review\Interfaces;

use App\Models\MySql\Review\ReviewMessageImage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface ReviewMessageImageRepositoryInterface
 *
 * @package App\Repositories\Review\Interfaces
 */
interface ReviewMessageImageRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return ReviewMessageImage|null
     */
    public function findById(
        int $id
    ) : ?ReviewMessageImage;

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
     * @param float $size
     * @param string $mime
     *
     * @return ReviewMessageImage|null
     */
    public function store(
        string $messageId,
        string $url,
        float $size,
        string $mime
    ) : ?ReviewMessageImage;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param ReviewMessageImage $reviewMessageImage
     * @param string|null $messageId
     * @param string|null $url
     * @param float|null $size
     * @param string|null $mime
     *
     * @return ReviewMessageImage
     */
    public function update(
        ReviewMessageImage $reviewMessageImage,
        ?string $messageId,
        ?string $url,
        ?float $size,
        ?string $mime
    ) : ReviewMessageImage;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param ReviewMessageImage $reviewMessageImage
     *
     * @return bool|null
     */
    public function delete(
        ReviewMessageImage $reviewMessageImage
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
