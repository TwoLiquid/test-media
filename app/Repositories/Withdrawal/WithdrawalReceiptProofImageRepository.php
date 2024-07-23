<?php

namespace App\Repositories\Withdrawal;

use App\Exceptions\DatabaseException;
use App\Models\MySql\WithdrawalReceiptProof\WithdrawalReceiptProofImage;
use App\Repositories\Withdrawal\Interfaces\WithdrawalReceiptProofImageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class WithdrawalReceiptProofImageRepository
 *
 * @package App\Repositories\Withdrawal
 */
class WithdrawalReceiptProofImageRepository implements WithdrawalReceiptProofImageRepositoryInterface
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
     * WithdrawalReceiptProofImageRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.withdrawalReceiptProofImage.perPage');
        $this->cacheTime = config('repositories.withdrawalReceiptProofImage.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return WithdrawalReceiptProofImage|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?WithdrawalReceiptProofImage
    {
        try {
            return WithdrawalReceiptProofImage::find($id);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/withdrawalReceiptProof/withdrawalReceiptProofImage.' . __FUNCTION__),
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
            return WithdrawalReceiptProofImage::all();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/withdrawalReceiptProof/withdrawalReceiptProofImage.' . __FUNCTION__),
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
            return WithdrawalReceiptProofImage::query()
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/withdrawalReceiptProof/withdrawalReceiptProofImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $receiptId
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getForReceipt(
        int $receiptId
    ) : Collection
    {
        try {
            return WithdrawalReceiptProofImage::query()
                ->where('receipt_id', '=', $receiptId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/withdrawalReceiptProof/withdrawalReceiptProofImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array $receiptsIds
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getForReceipts(
        array $receiptsIds
    ) : Collection
    {
        try {
            return WithdrawalReceiptProofImage::query()
                ->whereIn('receipt_id', $receiptsIds)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/withdrawalReceiptProof/withdrawalReceiptProofImage.' . __FUNCTION__),
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
            return WithdrawalReceiptProofImage::query()
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/withdrawalReceiptProof/withdrawalReceiptProofImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $receiptId
     * @param string $url
     * @param string $mime
     *
     * @return WithdrawalReceiptProofImage|null
     *
     * @throws DatabaseException
     */
    public function store(
        int $receiptId,
        string $url,
        string $mime
    ) : ?WithdrawalReceiptProofImage
    {
        try {
            return WithdrawalReceiptProofImage::create([
                'receipt_id' => $receiptId,
                'url'        => trim($url),
                'mime'       => trim($mime)
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/withdrawalReceiptProof/withdrawalReceiptProofImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param WithdrawalReceiptProofImage $withdrawalReceiptProofImage
     * @param int|null $receiptId
     * @param string|null $url
     * @param string|null $mime
     *
     * @return WithdrawalReceiptProofImage
     *
     * @throws DatabaseException
     */
    public function update(
        WithdrawalReceiptProofImage $withdrawalReceiptProofImage,
        ?int $receiptId,
        ?string $url,
        ?string $mime
    ) : WithdrawalReceiptProofImage
    {
        try {
            $withdrawalReceiptProofImage->update([
                'receipt_id' => $receiptId ?: $withdrawalReceiptProofImage->receipt_id,
                'url'        => $url ? trim($url) : $withdrawalReceiptProofImage->url,
                'mime'       => $mime ? trim($mime) : $withdrawalReceiptProofImage->mime
            ]);

            return $withdrawalReceiptProofImage;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/withdrawalReceiptProof/withdrawalReceiptProofImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param WithdrawalReceiptProofImage $withdrawalReceiptProofImage
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        WithdrawalReceiptProofImage $withdrawalReceiptProofImage
    ) : bool
    {
        try {
            return WithdrawalReceiptProofImage::query()
                ->where('id', '=', $withdrawalReceiptProofImage->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/withdrawalReceiptProof/withdrawalReceiptProofImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $receiptId
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function deleteForReceipt(
        int $receiptId
    ) : bool
    {
        try {
            return WithdrawalReceiptProofImage::query()
                ->where('receipt_id', '=', $receiptId)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/withdrawalReceiptProof/withdrawalReceiptProofImage.' . __FUNCTION__),
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
            return WithdrawalReceiptProofImage::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/withdrawalReceiptProof/withdrawalReceiptProofImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
