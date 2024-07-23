<?php

namespace App\Repositories\Payment;

use App\Exceptions\DatabaseException;
use App\Models\MySql\PaymentMethodImage;
use App\Repositories\Payment\Interfaces\PaymentMethodImageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class PaymentMethodImageRepository
 *
 * @package App\Repositories\Payment
 */
class PaymentMethodImageRepository implements PaymentMethodImageRepositoryInterface
{
    /**
     * Cache time
     *
     * @var int
     */
    protected int $cacheTime;

    /**
     * Pagination step
     *
     * @var int
     */
    protected int $perPage;

    /**
     * PaymentMethodImageRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.paymentMethodImage.perPage');
        $this->cacheTime = config('repositories.paymentMethodImage.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return PaymentMethodImage|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?PaymentMethodImage
    {
        try {
            return PaymentMethodImage::find($id);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/paymentMethodImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getAll() : Collection
    {
        try {
            return PaymentMethodImage::all();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/paymentMethodImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int|null $page
     *
     * @return LengthAwarePaginator
     *
     * @throws DatabaseException
     */
    public function getAllPaginated(
        ?int $page = null
    ) : LengthAwarePaginator
    {
        try {
            return PaymentMethodImage::query()
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/paymentMethodImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $paymentMethodId
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getForMethod(
        int $paymentMethodId
    ) : Collection
    {
        try {
            return PaymentMethodImage::query()
                ->where('method_id', '=', $paymentMethodId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/paymentMethodImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array $paymentMethodsIds
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getForMethods(
        array $paymentMethodsIds
    ) : Collection
    {
        try {
            return PaymentMethodImage::query()
                ->whereIn('method_id', $paymentMethodsIds)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/paymentMethodImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array $ids
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getByIds(
        array $ids
    ) : Collection
    {
        try {
            return PaymentMethodImage::query()
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/paymentMethodImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $paymentMethodId
     * @param string $url
     * @param string $mime
     *
     * @return PaymentMethodImage|null
     *
     * @throws DatabaseException
     */
    public function store(
        int $paymentMethodId,
        string $url,
        string $mime
    ) : ?PaymentMethodImage
    {
        try {
            return PaymentMethodImage::create([
                'method_id' => $paymentMethodId,
                'url'       => trim($url),
                'mime'      => trim($mime)
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/paymentMethodImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param PaymentMethodImage $paymentMethodImage
     * @param int|null $paymentMethodId
     * @param string|null $url
     * @param string|null $mime
     *
     * @return PaymentMethodImage
     *
     * @throws DatabaseException
     */
    public function update(
        PaymentMethodImage $paymentMethodImage,
        ?int $paymentMethodId,
        ?string $url,
        ?string $mime
    ) : PaymentMethodImage
    {
        try {
            $paymentMethodImage->update([
                'method_id' => $paymentMethodId ?: $paymentMethodImage->method_id,
                'url'       => $url ? trim($url) : $paymentMethodImage->url,
                'mime'      => $mime ? trim($mime) : $paymentMethodImage->mime

            ]);

            return $paymentMethodImage;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/paymentMethodImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param PaymentMethodImage $paymentMethodImage
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        PaymentMethodImage $paymentMethodImage
    ) : bool
    {
        try {
            return PaymentMethodImage::query()
                ->where('id', '=', $paymentMethodImage->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/paymentMethodImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $paymentMethodId
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function deleteForMethod(
        int $paymentMethodId
    ) : bool
    {
        try {
            return PaymentMethodImage::query()
                ->where('method_id', '=', $paymentMethodId)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/paymentMethodImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array $ids
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function deleteByIds(
        array $ids
    ) : bool
    {
        try {
            return PaymentMethodImage::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/paymentMethodImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
