<?php

namespace App\Repositories\Review;

use App\Exceptions\DatabaseException;
use App\Models\MySql\Review\ReviewMessageImage;
use App\Repositories\Review\Interfaces\ReviewMessageImageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class ReviewMessageImageRepository
 *
 * @package App\Repositories\Review
 */
class ReviewMessageImageRepository implements ReviewMessageImageRepositoryInterface
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
     * ReviewMessageImageRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.reviewMessageImage.perPage');
        $this->cacheTime = config('repositories.reviewMessageImage.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return ReviewMessageImage|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?ReviewMessageImage
    {
        try {
            return ReviewMessageImage::find($id);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageImage.' . __FUNCTION__),
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
            return ReviewMessageImage::query()
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageImage.' . __FUNCTION__),
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
            return ReviewMessageImage::query()
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageImage.' . __FUNCTION__),
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
            return ReviewMessageImage::query()
                ->whereIn('id', $ids ?? [])
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageImage.' . __FUNCTION__),
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
            return ReviewMessageImage::query()
                ->where('message_id', '=', $messageId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageImage.' . __FUNCTION__),
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
            return ReviewMessageImage::query()
                ->whereIn('message_id', $messagesIds)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageImage.' . __FUNCTION__),
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
            return ReviewMessageImage::query()
                ->where('message_id', '=', $messageId)
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param string $messageId
     * @param string $url
     * @param float $size
     * @param string $mime
     *
     * @return ReviewMessageImage|null
     *
     * @throws DatabaseException
     */
    public function store(
        string $messageId,
        string $url,
        float $size,
        string $mime
    ) : ?ReviewMessageImage
    {
        try {
            return ReviewMessageImage::create([
                'message_id' => trim($messageId),
                'url'        => trim($url),
                'size'       => $size,
                'mime'       => trim($mime)
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param ReviewMessageImage $reviewMessageImage
     * @param string|null $messageId
     * @param string|null $url
     * @param float|null $size
     * @param string|null $mime
     *
     * @return ReviewMessageImage
     *
     * @throws DatabaseException
     */
    public function update(
        ReviewMessageImage $reviewMessageImage,
        ?string $messageId,
        ?string $url,
        ?float $size,
        ?string $mime
    ) : ReviewMessageImage
    {
        try {
            $reviewMessageImage->update([
                'message_id' => $messageId ? trim($messageId) : $reviewMessageImage->message_id,
                'url'        => $url ? trim($url) : $reviewMessageImage->url,
                'size'       => $size ?: $reviewMessageImage->size,
                'mime'       => $mime ? trim($mime) : $reviewMessageImage->mime
            ]);

            return $reviewMessageImage;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param ReviewMessageImage $reviewMessageImage
     *
     * @return bool|null
     *
     * @throws DatabaseException
     */
    public function delete(
        ReviewMessageImage $reviewMessageImage
    ) : ?bool
    {
        try {
            return ReviewMessageImage::query()
                ->where('id' , '=', $reviewMessageImage->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageImage.' . __FUNCTION__),
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
            return ReviewMessageImage::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/review/reviewMessageImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
