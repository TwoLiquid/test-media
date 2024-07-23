<?php

namespace App\Repositories\Vybe;

use App\Exceptions\DatabaseException;
use App\Models\MySql\Vybe\VybeVideo;
use App\Models\MySql\Vybe\VybeVideoThumbnail;
use App\Repositories\Vybe\Interfaces\VybeVideoThumbnailRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class VybeVideoThumbnailRepository
 *
 * @package App\Repositories\Vybe
 */
class VybeVideoThumbnailRepository implements VybeVideoThumbnailRepositoryInterface
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
     * VybeVideoThumbnailRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.vybeVideoThumbnail.perPage');
        $this->cacheTime = config('repositories.vybeVideoThumbnail.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return VybeVideoThumbnail|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?VybeVideoThumbnail
    {
        try {
            return VybeVideoThumbnail::query()
                ->where('id', '=', $id)
                ->first();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeVideoThumbnail.' . __FUNCTION__),
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
            return VybeVideoThumbnail::query()
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeVideoThumbnail.' . __FUNCTION__),
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
            return VybeVideoThumbnail::query()
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeVideoThumbnail.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array $vybeVideoThumbnailsIds
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getByIds(
        array $vybeVideoThumbnailsIds
    ) : Collection
    {
        try {
            return VybeVideoThumbnail::query()
                ->whereIn('id', $vybeVideoThumbnailsIds)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeVideoThumbnail.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param VybeVideo $vybeVideo
     * @param string $url
     * @param string $mime
     *
     * @return VybeVideoThumbnail|null
     *
     * @throws DatabaseException
     */
    public function store(
        VybeVideo $vybeVideo,
        string $url,
        string $mime
    ) : ?VybeVideoThumbnail
    {
        try {
            return VybeVideoThumbnail::create([
                'video_id' => $vybeVideo->id,
                'url'      => trim($url),
                'mime'     => trim($mime),
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeVideoThumbnail.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param VybeVideoThumbnail $vybeVideoThumbnail
     * @param VybeVideo|null $vybeVideo
     * @param string|null $url
     * @param string|null $mime
     *
     * @return VybeVideoThumbnail
     *
     * @throws DatabaseException
     */
    public function update(
        VybeVideoThumbnail $vybeVideoThumbnail,
        ?VybeVideo $vybeVideo,
        ?string $url,
        ?string $mime
    ) : VybeVideoThumbnail
    {
        try {
            $vybeVideoThumbnail->update([
                'video_id' => $vybeVideo ? $vybeVideo->id : $vybeVideoThumbnail->video_id,
                'url'      => $url ? trim($url) : $vybeVideoThumbnail->url,
                'mime'     => $mime ? trim($mime) : $vybeVideoThumbnail->mime
            ]);

            return $vybeVideoThumbnail;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeVideoThumbnail.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param VybeVideoThumbnail $vybeVideoThumbnail
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        VybeVideoThumbnail $vybeVideoThumbnail
    ) : bool
    {
        try {
            return VybeVideoThumbnail::query()
                ->where('id', '=', $vybeVideoThumbnail->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeVideoThumbnail.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array $vybeVideosIds
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function deleteByVideosIds(
        array $vybeVideosIds
    ) : bool
    {
        try {
            return VybeVideoThumbnail::query()
                ->whereIn('video_id', $vybeVideosIds)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeVideoThumbnail.' . __FUNCTION__),
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
            return VybeVideoThumbnail::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeVideoThumbnail.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
