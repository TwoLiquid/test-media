<?php

namespace App\Repositories\VatNumber;

use App\Exceptions\DatabaseException;
use App\Models\MySql\VatNumberProof\VatNumberProofDocument;
use App\Repositories\VatNumber\Interfaces\VatNumberProofDocumentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class VatNumberProofDocumentRepository
 *
 * @package App\Repositories\VatNumber
 */
class VatNumberProofDocumentRepository implements VatNumberProofDocumentRepositoryInterface
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
     * VatNumberProofDocumentRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.vatNumberProofDocument.perPage');
        $this->cacheTime = config('repositories.vatNumberProofDocument.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return VatNumberProofDocument|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?VatNumberProofDocument
    {
        try {
            return VatNumberProofDocument::find($id);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vatNumberProof/vatNumberProofDocument.' . __FUNCTION__),
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
            return VatNumberProofDocument::all();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vatNumberProof/vatNumberProofDocument.' . __FUNCTION__),
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
            return VatNumberProofDocument::query()
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vatNumberProof/vatNumberProofDocument.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param string $vatNumberProofId
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getForVatNumberProof(
        string $vatNumberProofId
    ) : Collection
    {
        try {
            return VatNumberProofDocument::query()
                ->where('vat_number_proof_id', '=', $vatNumberProofId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vatNumberProof/vatNumberProofDocument.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array $vatNumberProofsIds
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getForVatNumberProofs(
        array $vatNumberProofsIds
    ) : Collection
    {
        try {
            return VatNumberProofDocument::query()
                ->whereIn('vat_number_proof_id', $vatNumberProofsIds)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vatNumberProof/vatNumberProofDocument.' . __FUNCTION__),
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
            return VatNumberProofDocument::query()
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vatNumberProof/vatNumberProofDocument.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param string $vatNumberProofId
     * @param string $url
     * @param string $mime
     *
     * @return VatNumberProofDocument|null
     *
     * @throws DatabaseException
     */
    public function store(
        string $vatNumberProofId,
        string $url,
        string $mime
    ) : ?VatNumberProofDocument
    {
        try {
            return VatNumberProofDocument::create([
                'vat_number_proof_id' => $vatNumberProofId,
                'url'                 => trim($url),
                'mime'                => trim($mime)
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vatNumberProof/vatNumberProofDocument.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param VatNumberProofDocument $vatNumberProofDocument
     * @param string|null $vatNumberProofId
     * @param string|null $url
     * @param string|null $mime
     *
     * @return VatNumberProofDocument
     *
     * @throws DatabaseException
     */
    public function update(
        VatNumberProofDocument $vatNumberProofDocument,
        ?string $vatNumberProofId,
        ?string $url,
        ?string $mime
    ) : VatNumberProofDocument
    {
        try {
            $vatNumberProofDocument->update([
                'vat_number_proof_id' => $vatNumberProofId ?: $vatNumberProofDocument->vat_number_proof_id,
                'url'                 => $url ? trim($url) : $vatNumberProofDocument->url,
                'mime'                => $mime ? trim($mime) : $vatNumberProofDocument->mime
            ]);

            return $vatNumberProofDocument;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vatNumberProof/vatNumberProofDocument.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param VatNumberProofDocument $vatNumberProofDocument
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        VatNumberProofDocument $vatNumberProofDocument
    ) : bool
    {
        try {
            return VatNumberProofDocument::query()
                ->where('id', '=', $vatNumberProofDocument->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vatNumberProof/vatNumberProofDocument.' . __FUNCTION__),
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
            return VatNumberProofDocument::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vatNumberProof/vatNumberProofDocument.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
