<?php

namespace App\Repositories\Support;

use App\Exceptions\DatabaseException;
use App\Models\MySql\Support\SupportTicketMessageVideo;
use App\Models\MySql\Support\SupportTicketMessageVideoThumbnail;
use App\Repositories\Support\Interfaces\SupportTicketMessageVideoThumbnailRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class SupportTicketMessageVideoThumbnailRepository
 *
 * @package App\Repositories\Support
 */
class SupportTicketMessageVideoThumbnailRepository implements SupportTicketMessageVideoThumbnailRepositoryInterface
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
     * SupportTicketMessageVideoThumbnailRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.supportTicketMessageVideoThumbnail.perPage');
        $this->cacheTime = config('repositories.supportTicketMessageVideoThumbnail.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return SupportTicketMessageVideoThumbnail|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?SupportTicketMessageVideoThumbnail
    {
        try {
            return SupportTicketMessageVideoThumbnail::find($id);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageVideoThumbnail.' . __FUNCTION__),
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
            return SupportTicketMessageVideoThumbnail::all();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageVideoThumbnail.' . __FUNCTION__),
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
            return SupportTicketMessageVideoThumbnail::query()
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageVideoThumbnail.' . __FUNCTION__),
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
            return SupportTicketMessageVideoThumbnail::query()
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageVideoThumbnail.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param SupportTicketMessageVideo $supportTicketMessageVideo
     * @param string $url
     * @param string $mime
     *
     * @return SupportTicketMessageVideoThumbnail|null
     *
     * @throws DatabaseException
     */
    public function store(
        SupportTicketMessageVideo $supportTicketMessageVideo,
        string $url,
        string $mime
    ) : ?SupportTicketMessageVideoThumbnail
    {
        try {
            return SupportTicketMessageVideoThumbnail::create([
                'video_id' => $supportTicketMessageVideo->id,
                'url'      => trim($url),
                'mime'     => trim($mime)
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageVideoThumbnail.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param SupportTicketMessageVideoThumbnail $supportTicketMessageVideoThumbnail
     * @param SupportTicketMessageVideo|null $supportTicketMessageVideo
     * @param string|null $url
     * @param string|null $mime
     *
     * @return SupportTicketMessageVideoThumbnail
     *
     * @throws DatabaseException
     */
    public function update(
        SupportTicketMessageVideoThumbnail $supportTicketMessageVideoThumbnail,
        ?SupportTicketMessageVideo $supportTicketMessageVideo,
        ?string $url,
        ?string $mime
    ) : SupportTicketMessageVideoThumbnail
    {
        try {
            $supportTicketMessageVideoThumbnail->update([
                'video_id' => $supportTicketMessageVideo ? $supportTicketMessageVideo->id : $supportTicketMessageVideoThumbnail->video_id,
                'url'      => $url ? trim($url) : $supportTicketMessageVideoThumbnail->url,
                'mime'     => $mime ? trim($mime) : $supportTicketMessageVideoThumbnail->mime
            ]);

            return $supportTicketMessageVideoThumbnail;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageVideoThumbnail.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param SupportTicketMessageVideoThumbnail $supportTicketMessageVideoThumbnail
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        SupportTicketMessageVideoThumbnail $supportTicketMessageVideoThumbnail
    ) : bool
    {
        try {
            return SupportTicketMessageVideoThumbnail::query()
                ->where('id', '=', $supportTicketMessageVideoThumbnail->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageVideoThumbnail.' . __FUNCTION__),
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
            return SupportTicketMessageVideoThumbnail::query()
                ->whereIn('video_id', $videosIds)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageVideoThumbnail.' . __FUNCTION__),
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
            return SupportTicketMessageVideoThumbnail::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageVideoThumbnail.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
