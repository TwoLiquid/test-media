<?php

namespace App\Repositories\Review;

use App\Exceptions\DatabaseException;
use App\Models\MySql\Review\ReviewMessageVideo;
use App\Models\MySql\Review\ReviewMessageVideoThumbnail;
use App\Repositories\Review\Interfaces\ReviewMessageVideoThumbnailRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class ReviewMessageVideoThumbnailRepository
 *
 * @package App\Repositories\Review
 */
class ReviewMessageVideoThumbnailRepository implements ReviewMessageVideoThumbnailRepositoryInterface
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
     * ReviewMessageVideoThumbnailRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.reviewMessageVideoThumbnail.perPage');
        $this->cacheTime = config('repositories.reviewMessageVideoThumbnail.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return ReviewMessageVideoThumbnail|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?ReviewMessageVideoThumbnail
    {
        try {
            return ReviewMessageVideoThumbnail::query()
                ->where('id', '=', $id)
                ->first();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageVideoThumbnail.' . __FUNCTION__),
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
            return ReviewMessageVideoThumbnail::query()
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageVideoThumbnail.' . __FUNCTION__),
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
            return ReviewMessageVideoThumbnail::query()
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageVideoThumbnail.' . __FUNCTION__),
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
            return ReviewMessageVideoThumbnail::query()
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageVideoThumbnail.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param ReviewMessageVideo $reviewMessageVideo
     * @param string $url
     * @param string $mime
     *
     * @return ReviewMessageVideoThumbnail|null
     *
     * @throws DatabaseException
     */
    public function store(
        ReviewMessageVideo $reviewMessageVideo,
        string $url,
        string $mime
    ) : ?ReviewMessageVideoThumbnail
    {
        try {
            return ReviewMessageVideoThumbnail::create([
                'video_id' => $reviewMessageVideo->id,
                'url'      => trim($url),
                'mime'     => trim($mime),
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageVideoThumbnail.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param ReviewMessageVideoThumbnail $reviewMessageVideoThumbnail
     * @param ReviewMessageVideo|null $reviewMessageVideo
     * @param string|null $url
     * @param string|null $mime
     *
     * @return ReviewMessageVideoThumbnail
     *
     * @throws DatabaseException
     */
    public function update(
        ReviewMessageVideoThumbnail $reviewMessageVideoThumbnail,
        ?ReviewMessageVideo $reviewMessageVideo,
        ?string $url,
        ?string $mime
    ) : ReviewMessageVideoThumbnail
    {
        try {
            $reviewMessageVideoThumbnail->update([
                'video_id' => $reviewMessageVideo ? $reviewMessageVideo->id : $reviewMessageVideoThumbnail->video_id,
                'url'      => $url ? trim($url) : $reviewMessageVideoThumbnail->url,
                'mime'     => $mime ? trim($mime) : $reviewMessageVideoThumbnail->mime
            ]);

            return $reviewMessageVideoThumbnail;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageVideoThumbnail.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param ReviewMessageVideoThumbnail $reviewMessageVideoThumbnail
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        ReviewMessageVideoThumbnail $reviewMessageVideoThumbnail
    ) : bool
    {
        try {
            return ReviewMessageVideoThumbnail::query()
                ->where('id', '=', $reviewMessageVideoThumbnail->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageVideoThumbnail.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array $videosIds
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function deleteByVideosIds(
        array $videosIds
    ) : bool
    {
        try {
            return ReviewMessageVideoThumbnail::query()
                ->whereIn('video_id', $videosIds)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageVideoThumbnail.' . __FUNCTION__),
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
            return ReviewMessageVideoThumbnail::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageVideoThumbnail.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
