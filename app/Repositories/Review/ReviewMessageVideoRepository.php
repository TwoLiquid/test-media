<?php

namespace App\Repositories\Review;

use App\Exceptions\DatabaseException;
use App\Models\MySql\Review\ReviewMessageVideo;
use App\Repositories\Review\Interfaces\ReviewMessageVideoRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class ReviewMessageVideoRepository
 *
 * @package App\Repositories\Review
 */
class ReviewMessageVideoRepository implements ReviewMessageVideoRepositoryInterface
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
     * ReviewMessageVideoRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.reviewMessageVideo.perPage');
        $this->cacheTime = config('repositories.reviewMessageVideo.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return ReviewMessageVideo|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?ReviewMessageVideo
    {
        try {
            return ReviewMessageVideo::query()
                ->where('id', '=', $id)
                ->first();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageVideo.' . __FUNCTION__),
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
            return ReviewMessageVideo::query()
                ->with([
                    'thumbnail'
                ])
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageVideo.' . __FUNCTION__),
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
            return ReviewMessageVideo::query()
                ->with([
                    'thumbnail'
                ])
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array|null $ids
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getByIds(
        ?array $ids
    ) : Collection
    {
        try {
            return ReviewMessageVideo::query()
                ->with([
                    'thumbnail'
                ])
                ->whereIn('id', $vybeVideosIds ?? [])
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param string $messageId
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getForMessage(
        string $messageId
    ) : Collection
    {
        try {
            return ReviewMessageVideo::query()
                ->with([
                    'thumbnail'
                ])
                ->where('message_id', '=', $messageId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array $messagesIds
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getForMessages(
        array $messagesIds
    ) : Collection
    {
        try {
            return ReviewMessageVideo::query()
                ->with([
                    'thumbnail'
                ])
                ->whereIn('message_id', $messagesIds)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param string $messageId
     * @param array $ids
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getForMessageByIds(
        string $messageId,
        array $ids
    ) : Collection
    {
        try {
            return ReviewMessageVideo::query()
                ->with([
                    'thumbnail'
                ])
                ->where('message_id', '=', $messageId)
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param string $messageId
     * @param string $url
     * @param int $duration
     * @param float $size
     * @param string $mime
     *
     * @return ReviewMessageVideo|null
     *
     * @throws DatabaseException
     */
    public function store(
        string $messageId,
        string $url,
        int $duration,
        float $size,
        string $mime
    ) : ?ReviewMessageVideo
    {
        try {
            return ReviewMessageVideo::create([
                'message_id' => trim($messageId),
                'url'        => trim($url),
                'duration'   => $duration,
                'size'       => $size,
                'mime'       => trim($mime),
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param ReviewMessageVideo $reviewMessageVideo
     * @param string|null $messageId
     * @param string|null $url
     * @param int|null $duration
     * @param float|null $size
     * @param string|null $mime
     *
     * @return ReviewMessageVideo
     *
     * @throws DatabaseException
     */
    public function update(
        ReviewMessageVideo $reviewMessageVideo,
        ?string $messageId,
        ?string $url,
        ?int $duration,
        ?float $size,
        ?string $mime
    ) : ReviewMessageVideo
    {
        try {
            $reviewMessageVideo->update([
                'message_id' => $messageId ? trim($messageId) : $reviewMessageVideo->message_id,
                'url'        => $url ? trim($url) : $reviewMessageVideo->url,
                'duration'   => $duration ?: $reviewMessageVideo->duration,
                'size'       => $size ?: $reviewMessageVideo->size,
                'mime'       => $mime ? trim($mime) : $reviewMessageVideo->mime,
            ]);

            return $reviewMessageVideo;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param ReviewMessageVideo $reviewMessageVideo
     *
     * @return bool|null
     *
     * @throws DatabaseException
     */
    public function delete(
        ReviewMessageVideo $reviewMessageVideo
    ) : ?bool
    {
        try {
            return ReviewMessageVideo::query()
                ->where('id', '=', $reviewMessageVideo->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array $ids
     *
     * @return bool|null
     *
     * @throws DatabaseException
     */
    public function deleteByIds(
        array $ids
    ) : ?bool
    {
        try {
            return ReviewMessageVideo::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
