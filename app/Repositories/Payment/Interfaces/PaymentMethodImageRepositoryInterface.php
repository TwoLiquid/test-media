<?php

namespace App\Repositories\Payment\Interfaces;

use App\Models\MySql\PaymentMethodImage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface PaymentMethodImageRepositoryInterface
 *
 * @package App\Repositories\Payment\Interfaces
 */
interface PaymentMethodImageRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return PaymentMethodImage|null
     */
    public function findById(
        int $id
    ) : ?PaymentMethodImage;

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
     * @param int $paymentMethodId
     *
     * @return Collection
     */
    public function getForMethod(
        int $paymentMethodId
    ) : Collection;

    /**
     * This method provides getting rows
     * with an eloquent model by certain query
     *
     * @param array $paymentMethodsIds
     *
     * @return Collection
     */
    public function getForMethods(
        array $paymentMethodsIds
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
     * with an eloquent model
     *
     * @param int $paymentMethodId
     * @param string $url
     * @param string $mime
     *
     * @return PaymentMethodImage|null
     */
    public function store(
        int $paymentMethodId,
        string $url,
        string $mime
    ) : ?PaymentMethodImage;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param PaymentMethodImage $paymentMethodImage
     * @param int|null $paymentMethodId
     * @param string|null $url
     * @param string|null $mime
     *
     * @return PaymentMethodImage
     */
    public function update(
        PaymentMethodImage $paymentMethodImage,
        ?int $paymentMethodId,
        ?string $url,
        ?string $mime
    ) : PaymentMethodImage;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param PaymentMethodImage $paymentMethodImage
     *
     * @return bool
     */
    public function delete(
        PaymentMethodImage $paymentMethodImage
    ) : bool;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param int $paymentMethodId
     *
     * @return bool
     */
    public function deleteForMethod(
        int $paymentMethodId
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
