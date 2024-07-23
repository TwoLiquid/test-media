<?php

namespace App\Repositories\Vybe\Interfaces;

use App\Models\MySql\Vybe\VybeVideo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface VybeVideoRepositoryInterface
 *
 * @package App\Repositories\Vybe\Interfaces
 */
interface VybeVideoRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return VybeVideo|null
     */
    public function findById(
        int $id
    ) : ?VybeVideo;

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
     * @param array|null $vybeVideosIds
     *
     * @return Collection
     */
    public function getByIds(
        ?array $vybeVideosIds
    ) : Collection;

    /**
     * This method provides creating a new row
     * with an eloquent model
     *
     * @param string $url
     * @param int $duration
     * @param string $mime
     * @param bool|null $main
     * @param bool|null $declined
     *
     * @return VybeVideo|null
     */
    public function store(
        string $url,
        int $duration,
        string $mime,
        ?bool $main,
        ?bool $declined
    ) : ?VybeVideo;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param VybeVideo $vybeVideo
     * @param string|null $url
     * @param int|null $duration
     * @param string|null $mime
     * @param bool|null $main
     * @param bool|null $declined
     *
     * @return VybeVideo
     */
    public function update(
        VybeVideo $vybeVideo,
        ?string $url,
        ?int $duration,
        ?string $mime,
        ?bool $main,
        ?bool $declined
    ) : VybeVideo;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param VybeVideo $vybeVideo
     *
     * @return VybeVideo
     */
    public function accept(
        VybeVideo $vybeVideo
    ) : VybeVideo;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param VybeVideo $vybeVideo
     *
     * @return VybeVideo
     */
    public function decline(
        VybeVideo $vybeVideo
    ) : VybeVideo;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param VybeVideo $vybeVideo
     *
     * @return bool|null
     */
    public function delete(
        VybeVideo $vybeVideo
    ) : ?bool;

    /**
     * This method provides deleting existing rows
     * with an eloquent model
     *
     * @param array $vybeVideosIds
     *
     * @return bool|null
     */
    public function deleteByIds(
        array $vybeVideosIds
    ) : ?bool;
}
