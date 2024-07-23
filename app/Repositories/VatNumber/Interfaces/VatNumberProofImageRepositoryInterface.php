<?php

namespace App\Repositories\VatNumber\Interfaces;

use App\Models\MySql\VatNumberProof\VatNumberProofImage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface VatNumberProofImageRepositoryInterface
 *
 * @package App\Repositories\VatNumber\Interfaces
 */
interface VatNumberProofImageRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return VatNumberProofImage|null
     */
    public function findById(
        int $id
    ) : ?VatNumberProofImage;

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
     * This method provides getting all rows
     * with an eloquent model by certain query
     *
     * @param string $vatNumberProofId
     *
     * @return Collection
     */
    public function getForVatNumberProof(
        string $vatNumberProofId
    ) : Collection;

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
     * @param string $vatNumberProofId
     * @param string $url
     * @param string $mime
     *
     * @return VatNumberProofImage|null
     */
    public function store(
        string $vatNumberProofId,
        string $url,
        string $mime
    ) : ?VatNumberProofImage;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param VatNumberProofImage $vatNumberProofImage
     * @param string|null $vatNumberProofId
     * @param string|null $url
     * @param string|null $mime
     *
     * @return VatNumberProofImage
     */
    public function update(
        VatNumberProofImage $vatNumberProofImage,
        ?string $vatNumberProofId,
        ?string $url,
        ?string $mime
    ) : VatNumberProofImage;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param VatNumberProofImage $vatNumberProofImage
     *
     * @return bool
     */
    public function delete(
        VatNumberProofImage $vatNumberProofImage
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
