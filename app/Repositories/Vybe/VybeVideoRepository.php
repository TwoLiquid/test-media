<?php

namespace App\Repositories\Vybe;

use App\Exceptions\DatabaseException;
use App\Models\MySql\Vybe\VybeVideo;
use App\Repositories\Vybe\Interfaces\VybeVideoRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class VybeVideoRepository
 *
 * @package App\Repositories\Vybe
 */
class VybeVideoRepository implements VybeVideoRepositoryInterface
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
     * VybeVideoRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.vybeVideo.perPage');
        $this->cacheTime = config('repositories.vybeVideo.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return VybeVideo|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?VybeVideo
    {
        try {
            return VybeVideo::query()
                ->where('id', '=', $id)
                ->first();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeVideo.' . __FUNCTION__),
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
            return VybeVideo::query()
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeVideo.' . __FUNCTION__),
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
            return VybeVideo::query()
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array|null $vybeVideosIds
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getByIds(
        ?array $vybeVideosIds
    ) : Collection
    {
        try {
            return VybeVideo::query()
                ->whereIn('id', $vybeVideosIds ?? [])
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param string $url
     * @param int $duration
     * @param string $mime
     * @param bool|null $main
     * @param bool|null $declined
     *
     * @return VybeVideo|null
     *
     * @throws DatabaseException
     */
    public function store(
        string $url,
        int $duration,
        string $mime,
        ?bool $main = false,
        ?bool $declined = false
    ) : ?VybeVideo
    {
        try {
            return VybeVideo::create([
                'url'      => trim($url),
                'duration' => $duration,
                'mime'     => trim($mime),
                'main'     => is_null($main) ? false : $main,
                'declined' => is_null($declined) ? false : $declined
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param VybeVideo $vybeVideo
     * @param string|null $url
     * @param int|null $duration
     * @param string|null $mime
     * @param bool|null $main
     * @param bool|null $declined
     *
     * @return VybeVideo
     *
     * @throws DatabaseException
     */
    public function update(
        VybeVideo $vybeVideo,
        ?string $url,
        ?int $duration,
        ?string $mime,
        ?bool $main,
        ?bool $declined
    ) : VybeVideo
    {
        try {
            $vybeVideo->update([
                'url'      => $url ? trim($url) : $vybeVideo->url,
                'duration' => $duration ?: $vybeVideo->duration,
                'mime'     => $mime ? trim($mime) : $vybeVideo->mime,
                'main'     => $main ?: $vybeVideo->main,
                'declined' => $declined ?: $vybeVideo->declined
            ]);

            return $vybeVideo;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param VybeVideo $vybeVideo
     *
     * @return VybeVideo
     *
     * @throws DatabaseException
     */
    public function accept(
        VybeVideo $vybeVideo
    ) : VybeVideo
    {
        try {
            $vybeVideo->update([
                'declined' => false
            ]);

            return $vybeVideo;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param VybeVideo $vybeVideo
     *
     * @return VybeVideo
     *
     * @throws DatabaseException
     */
    public function decline(
        VybeVideo $vybeVideo
    ) : VybeVideo
    {
        try {
            $vybeVideo->update([
                'declined' => true
            ]);

            return $vybeVideo;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param VybeVideo $vybeVideo
     *
     * @return bool|null
     *
     * @throws DatabaseException
     */
    public function delete(
        VybeVideo $vybeVideo
    ) : ?bool
    {
        try {
            return VybeVideo::query()
                ->where('id', '=', $vybeVideo->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array $vybeVideosIds
     *
     * @return bool|null
     *
     * @throws DatabaseException
     */
    public function deleteByIds(
        array $vybeVideosIds
    ) : ?bool
    {
        try {
            return VybeVideo::query()
                ->whereIn('id', $vybeVideosIds)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/vybe/vybeVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
