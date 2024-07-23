<?php

namespace App\Repositories\Withdrawal\Interfaces;

use App\Models\MySql\WithdrawalReceiptProof\WithdrawalReceiptProofImage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface WithdrawalReceiptProofImageRepositoryInterface
 *
 * @package App\Repositories\Withdrawal\Interfaces
 */
interface WithdrawalReceiptProofImageRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return WithdrawalReceiptProofImage|null
     */
    public function findById(
        int $id
    ) : ?WithdrawalReceiptProofImage;

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
     * @return WithdrawalReceiptProofImage|null
     */
    public function store(
        int $receiptId,
        string $url,
        string $mime
    ) : ?WithdrawalReceiptProofImage;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param WithdrawalReceiptProofImage $withdrawalReceiptProofImage
     * @param int|null $receiptId
     * @param string|null $url
     * @param string|null $mime
     *
     * @return WithdrawalReceiptProofImage
     */
    public function update(
        WithdrawalReceiptProofImage $withdrawalReceiptProofImage,
        ?int $receiptId,
        ?string $url,
        ?string $mime
    ) : WithdrawalReceiptProofImage;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param WithdrawalReceiptProofImage $withdrawalReceiptProofImage
     *
     * @return bool
     */
    public function delete(
        WithdrawalReceiptProofImage $withdrawalReceiptProofImage
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
