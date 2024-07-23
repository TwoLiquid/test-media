<?php

namespace App\Repositories\Withdrawal;

use App\Exceptions\DatabaseException;
use App\Models\MySql\WithdrawalReceiptProof\WithdrawalReceiptProofDocument;
use App\Repositories\Withdrawal\Interfaces\WithdrawalReceiptProofDocumentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class WithdrawalReceiptProofDocumentRepository
 *
 * @package App\Repositories\Withdrawal
 */
class WithdrawalReceiptProofDocumentRepository implements WithdrawalReceiptProofDocumentRepositoryInterface
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
     * WithdrawalReceiptProofDocumentRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.withdrawalReceiptProofDocument.perPage');
        $this->cacheTime = config('repositories.withdrawalReceiptProofDocument.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return WithdrawalReceiptProofDocument|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?WithdrawalReceiptProofDocument
    {
        try {
            return WithdrawalReceiptProofDocument::find($id);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/withdrawalReceiptProof/withdrawalReceiptProofDocument.' . __FUNCTION__),
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
            return WithdrawalReceiptProofDocument::all();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/withdrawalReceiptProof/withdrawalReceiptProofDocument.' . __FUNCTION__),
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
            return WithdrawalReceiptProofDocument::query()
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/withdrawalReceiptProof/withdrawalReceiptProofDocument.' . __FUNCTION__),
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
            return WithdrawalReceiptProofDocument::query()
                ->where('receipt_id', '=', $receiptId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/withdrawalReceiptProof/withdrawalReceiptProofDocument.' . __FUNCTION__),
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
            return WithdrawalReceiptProofDocument::query()
                ->whereIn('receipt_id', $receiptsIds)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/withdrawalReceiptProof/withdrawalReceiptProofDocument.' . __FUNCTION__),
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
            return WithdrawalReceiptProofDocument::query()
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/withdrawalReceiptProof/withdrawalReceiptProofDocument.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $receiptId
     * @param string $url
     * @param string $mime
     *
     * @return WithdrawalReceiptProofDocument|null
     *
     * @throws DatabaseException
     */
    public function store(
        int $receiptId,
        string $url,
        string $mime
    ) : ?WithdrawalReceiptProofDocument
    {
        try {
            return WithdrawalReceiptProofDocument::create([
                'receipt_id' => $receiptId,
                'url'        => trim($url),
                'mime'       => trim($mime)
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/withdrawalReceiptProof/withdrawalReceiptProofDocument.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param WithdrawalReceiptProofDocument $withdrawalReceiptProofDocument
     * @param int|null $receiptId
     * @param string|null $url
     * @param string|null $mime
     *
     * @return WithdrawalReceiptProofDocument
     *
     * @throws DatabaseException
     */
    public function update(
        WithdrawalReceiptProofDocument $withdrawalReceiptProofDocument,
        ?int $receiptId,
        ?string $url,
        ?string $mime
    ) : WithdrawalReceiptProofDocument
    {
        try {
            $withdrawalReceiptProofDocument->update([
                'receipt_id' => $receiptId ?: $withdrawalReceiptProofDocument->receipt_id,
                'url'        => $url ? trim($url) : $withdrawalReceiptProofDocument->url,
                'mime'       => $mime ? trim($mime) : $withdrawalReceiptProofDocument->mime
            ]);

            return $withdrawalReceiptProofDocument;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/withdrawalReceiptProof/withdrawalReceiptProofDocument.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param WithdrawalReceiptProofDocument $withdrawalReceiptProofDocument
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        WithdrawalReceiptProofDocument $withdrawalReceiptProofDocument
    ) : bool
    {
        try {
            return WithdrawalReceiptProofDocument::query()
                ->where('id', '=', $withdrawalReceiptProofDocument->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/withdrawalReceiptProof/withdrawalReceiptProofDocument.' . __FUNCTION__),
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
            return WithdrawalReceiptProofDocument::query()
                ->where('receipt_id', '=', $receiptId)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/withdrawalReceiptProof/withdrawalReceiptProofDocument.' . __FUNCTION__),
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
            return WithdrawalReceiptProofDocument::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/withdrawalReceiptProof/withdrawalReceiptProofDocument.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
