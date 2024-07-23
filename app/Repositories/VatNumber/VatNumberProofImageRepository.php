<?php

namespace App\Repositories\VatNumber;

use App\Exceptions\DatabaseException;
use App\Models\MySql\VatNumberProof\VatNumberProofImage;
use App\Repositories\VatNumber\Interfaces\VatNumberProofImageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class VatNumberProofImageRepository
 *
 * @package App\Repositories\VatNumber
 */
class VatNumberProofImageRepository implements VatNumberProofImageRepositoryInterface
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
     * VatNumberProofImageRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.vatNumberProofImage.perPage');
        $this->cacheTime = config('repositories.vatNumberProofImage.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return VatNumberProofImage|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?VatNumberProofImage
    {
        try {
            return VatNumberProofImage::find($id);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vatNumberProof/vatNumberProofImage.' . __FUNCTION__),
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
            return VatNumberProofImage::all();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vatNumberProof/vatNumberProofImage.' . __FUNCTION__),
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
            return VatNumberProofImage::query()
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vatNumberProof/vatNumberProofImage.' . __FUNCTION__),
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
            return VatNumberProofImage::query()
                ->where('vat_number_proof_id', '=', $vatNumberProofId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vatNumberProof/vatNumberProofImage.' . __FUNCTION__),
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
            return VatNumberProofImage::query()
                ->whereIn('vat_number_proof_id', $vatNumberProofsIds)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vatNumberProof/vatNumberProofImage.' . __FUNCTION__),
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
            return VatNumberProofImage::query()
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vatNumberProof/vatNumberProofImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param string $vatNumberProofId
     * @param string $url
     * @param string $mime
     *
     * @return VatNumberProofImage|null
     *
     * @throws DatabaseException
     */
    public function store(
        string $vatNumberProofId,
        string $url,
        string $mime
    ) : ?VatNumberProofImage
    {
        try {
            return VatNumberProofImage::create([
                'vat_number_proof_id' => $vatNumberProofId,
                'url'                 => trim($url),
                'mime'                => trim($mime)
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vatNumberProof/vatNumberProofImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param VatNumberProofImage $vatNumberProofImage
     * @param string|null $vatNumberProofId
     * @param string|null $url
     * @param string|null $mime
     *
     * @return VatNumberProofImage
     *
     * @throws DatabaseException
     */
    public function update(
        VatNumberProofImage $vatNumberProofImage,
        ?string $vatNumberProofId,
        ?string $url,
        ?string $mime
    ) : VatNumberProofImage
    {
        try {
            $vatNumberProofImage->update([
                'vat_number_proof_id' => $vatNumberProofId ?: $vatNumberProofImage->vat_number_proof_id,
                'url'                 => $url ? trim($url) : $vatNumberProofImage->url,
                'mime'                => $mime ? trim($mime) : $vatNumberProofImage->mime
            ]);

            return $vatNumberProofImage;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vatNumberProof/vatNumberProofImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param VatNumberProofImage $vatNumberProofImage
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        VatNumberProofImage $vatNumberProofImage
    ) : bool
    {
        try {
            return VatNumberProofImage::query()
                ->where('id', '=', $vatNumberProofImage->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vatNumberProof/vatNumberProofImage.' . __FUNCTION__),
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
            return VatNumberProofImage::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vatNumberProof/vatNumberProofImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
