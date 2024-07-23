<?php

namespace App\Repositories\Vybe;

use App\Exceptions\DatabaseException;
use App\Models\MySql\Vybe\VybeImage;
use App\Repositories\Vybe\Interfaces\VybeImageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class VybeImageRepository
 *
 * @package App\Repositories\Vybe
 */
class VybeImageRepository implements VybeImageRepositoryInterface
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
     * VybeImageRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.vybeImage.perPage');
        $this->cacheTime = config('repositories.vybeImage.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return VybeImage|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?VybeImage
    {
        try {
            return VybeImage::find($id);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeImage.' . __FUNCTION__),
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
            return VybeImage::query()
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeImage.' . __FUNCTION__),
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
        ?int $page
    ) : LengthAwarePaginator
    {
        try {
            return VybeImage::query()
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array|null $vybeImagesIds
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getByIds(
        ?array $vybeImagesIds
    ) : Collection
    {
        try {
            return VybeImage::query()
                ->whereIn('id', $vybeImagesIds ?? [])
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param string $url
     * @param string $mime
     * @param bool|null $main
     * @param bool|null $declined
     *
     * @return VybeImage|null
     *
     * @throws DatabaseException
     */
    public function store(
        string $url,
        string $mime,
        ?bool $main = false,
        ?bool $declined = false
    ) : ?VybeImage
    {
        try {
            return VybeImage::create([
                'url'      => trim($url),
                'mime'     => trim($mime),
                'main'     => is_null($main) ? false : $main,
                'declined' => is_null($declined) ? false : $declined
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param VybeImage $vybeImage
     * @param string|null $url
     * @param string|null $mime
     * @param bool|null $main
     * @param bool|null $declined
     *
     * @return VybeImage
     *
     * @throws DatabaseException
     */
    public function update(
        VybeImage $vybeImage,
        ?string $url,
        ?string $mime,
        ?bool $main,
        ?bool $declined
    ) : VybeImage
    {
        try {
            $vybeImage->update([
                'url'      => $url ? trim($url) : $vybeImage->url,
                'mime'     => $mime ? trim($mime) : $vybeImage->mime,
                'main'     => !is_null($main) ? $main : $vybeImage->main,
                'declined' => $declined ?: $vybeImage->declined
            ]);

            return $vybeImage;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param VybeImage $vybeImage
     *
     * @return VybeImage
     *
     * @throws DatabaseException
     */
    public function accept(
        VybeImage $vybeImage
    ) : VybeImage
    {
        try {
            $vybeImage->update([
                'declined' => false
            ]);

            return $vybeImage;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param VybeImage $vybeImage
     *
     * @return VybeImage
     *
     * @throws DatabaseException
     */
    public function decline(
        VybeImage $vybeImage
    ) : VybeImage
    {
        try {
            $vybeImage->update([
                'declined' => true
            ]);

            return $vybeImage;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param VybeImage $vybeImage
     *
     * @return bool|null
     *
     * @throws DatabaseException
     */
    public function delete(
        VybeImage $vybeImage
    ) : ?bool
    {
        try {
            return VybeImage::query()
                ->where('id' , '=', $vybeImage->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array $vybeImagesIds
     *
     * @return bool|null
     *
     * @throws DatabaseException
     */
    public function deleteByIds(
        array $vybeImagesIds
    ) : ?bool
    {
        try {
            return VybeImage::query()
                ->whereIn('id', $vybeImagesIds)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
