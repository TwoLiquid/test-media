<?php

namespace App\Repositories\VatNumber\Interfaces;

use App\Models\MySql\VatNumberProof\VatNumberProofDocument;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface VatNumberProofDocumentRepositoryInterface
 *
 * @package App\Repositories\VatNumber\Interfaces
 */
interface VatNumberProofDocumentRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return VatNumberProofDocument|null
     */
    public function findById(
        int $id
    ) : ?VatNumberProofDocument;

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
     * @return VatNumberProofDocument|null
     */
    public function store(
        string $vatNumberProofId,
        string $url,
        string $mime
    ) : ?VatNumberProofDocument;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param VatNumberProofDocument $vatNumberProofDocument
     * @param string|null $vatNumberProofId
     * @param string|null $url
     * @param string|null $mime
     *
     * @return VatNumberProofDocument
     */
    public function update(
        VatNumberProofDocument $vatNumberProofDocument,
        ?string $vatNumberProofId,
        ?string $url,
        ?string $mime
    ) : VatNumberProofDocument;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param VatNumberProofDocument $vatNumberProofDocument
     *
     * @return bool
     */
    public function delete(
        VatNumberProofDocument $vatNumberProofDocument
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
