<?php

namespace App\Repositories\Vybe\Interfaces;

use App\Models\MySql\Vybe\VybeImage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface VybeImageRepositoryInterface
 *
 * @package App\Repositories\Vybe\Interfaces
 */
interface VybeImageRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return VybeImage|null
     */
    public function findById(
        int $id
    ) : ?VybeImage;

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
     * @param array|null $vybeImagesIds
     *
     * @return Collection
     */
    public function getByIds(
        ?array $vybeImagesIds
    ) : Collection;

    /**
     * This method provides creating a new row
     * with an eloquent model
     *
     * @param string $url
     * @param string $mime
     * @param bool|null $main
     * @param bool|null $declined
     *
     * @return VybeImage|null
     */
    public function store(
        string $url,
        string $mime,
        ?bool $main,
        ?bool $declined
    ) : ?VybeImage;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param VybeImage $vybeImage
     * @param string|null $url
     * @param string|null $mime
     * @param bool|null $main
     * @param bool|null $declined
     *
     * @return VybeImage
     */
    public function update(
        VybeImage $vybeImage,
        ?string $url,
        ?string $mime,
        ?bool $main,
        ?bool $declined
    ) : VybeImage;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param VybeImage $vybeImage
     *
     * @return VybeImage
     */
    public function accept(
        VybeImage $vybeImage
    ) : VybeImage;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param VybeImage $vybeImage
     *
     * @return VybeImage
     */
    public function decline(
        VybeImage $vybeImage
    ) : VybeImage;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param VybeImage $vybeImage
     *
     * @return bool|null
     */
    public function delete(
        VybeImage $vybeImage
    ) : ?bool;

    /**
     * This method provides deleting existing rows
     * with an eloquent model
     *
     * @param array $vybeImagesIds
     *
     * @return bool|null
     */
    public function deleteByIds(
        array $vybeImagesIds
    ) : ?bool;
}
