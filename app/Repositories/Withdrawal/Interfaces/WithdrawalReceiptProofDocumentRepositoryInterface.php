<?php

namespace App\Repositories\Withdrawal\Interfaces;

use App\Models\MySql\WithdrawalReceiptProof\WithdrawalReceiptProofDocument;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface WithdrawalReceiptProofDocumentRepositoryInterface
 *
 * @package App\Repositories\Withdrawal\Interfaces
 */
interface WithdrawalReceiptProofDocumentRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return WithdrawalReceiptProofDocument|null
     */
    public function findById(
        int $id
    ) : ?WithdrawalReceiptProofDocument;

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
     * @param int $receiptId
     *
     * @return Collection
     */
    public function getForReceipt(
        int $receiptId
    ) : Collection;

    /**
     * This method provides getting all rows
     * with an eloquent model by certain query
     *
     * @param array $receiptsIds
     *
     * @return Collection
     */
    public function getForReceipts(
        array $receiptsIds
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
     * @param int $receiptId
     * @param string $url
     * @param string $mime
     *
     * @return WithdrawalReceiptProofDocument|null
     */
    public function store(
        int $receiptId,
        string $url,
        string $mime
    ) : ?WithdrawalReceiptProofDocument;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param WithdrawalReceiptProofDocument $withdrawalReceiptProofDocument
     * @param int|null $receiptId
     * @param string|null $url
     * @param string|null $mime
     *
     * @return WithdrawalReceiptProofDocument
     */
    public function update(
        WithdrawalReceiptProofDocument $withdrawalReceiptProofDocument,
        ?int $receiptId,
        ?string $url,
        ?string $mime
    ) : WithdrawalReceiptProofDocument;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param WithdrawalReceiptProofDocument $withdrawalReceiptProofDocument
     *
     * @return bool
     */
    public function delete(
        WithdrawalReceiptProofDocument $withdrawalReceiptProofDocument
    ) : bool;

    /**
     * This method provides deleting existing rows
     * with an eloquent model
     *
     * @param int $receiptId
     *
     * @return bool
     */
    public function deleteForReceipt(
        int $receiptId
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
