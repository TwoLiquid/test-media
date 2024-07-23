<?php

namespace App\Repositories\Chat;

use App\Exceptions\DatabaseException;
use App\Models\MySql\Chat\ChatMessageVideo;
use App\Models\MySql\Chat\ChatMessageVideoThumbnail;
use App\Repositories\Chat\Interfaces\ChatMessageVideoThumbnailRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class ChatMessageVideoThumbnailRepository
 *
 * @package App\Repositories\Chat
 */
class ChatMessageVideoThumbnailRepository implements ChatMessageVideoThumbnailRepositoryInterface
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
     * ChatMessageVideoThumbnailRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.chatMessageVideoThumbnail.perPage');
        $this->cacheTime = config('repositories.chatMessageVideoThumbnail.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return ChatMessageVideoThumbnail|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?ChatMessageVideoThumbnail
    {
        try {
            return ChatMessageVideoThumbnail::find($id);
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
            return ChatMessageVideoThumbnail::all();
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
            return ChatMessageVideoThumbnail::query()
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
            return ChatMessageVideoThumbnail::query()
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
     * @param ChatMessageVideo $chatMessageVideo
     * @param string $url
     * @param string $mime
     *
     * @return ChatMessageVideoThumbnail|null
     *
     * @throws DatabaseException
     */
    public function store(
        ChatMessageVideo $chatMessageVideo,
        string $url,
        string $mime
    ) : ?ChatMessageVideoThumbnail
    {
        try {
            return ChatMessageVideoThumbnail::create([
                'video_id' => $chatMessageVideo->id,
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
     * @param ChatMessageVideoThumbnail $chatMessageVideoThumbnail
     * @param ChatMessageVideo|null $chatMessageVideo
     * @param string|null $url
     * @param string|null $mime
     *
     * @return ChatMessageVideoThumbnail
     *
     * @throws DatabaseException
     */
    public function update(
        ChatMessageVideoThumbnail $chatMessageVideoThumbnail,
        ?ChatMessageVideo $chatMessageVideo,
        ?string $url,
        ?string $mime
    ) : ChatMessageVideoThumbnail
    {
        try {
            $chatMessageVideoThumbnail->update([
                'video_id' => $chatMessageVideo ? $chatMessageVideo->id : $chatMessageVideoThumbnail->video_id,
                'url'      => $url ? trim($url) : $chatMessageVideoThumbnail->url,
                'mime'     => $mime ? trim($mime) : $chatMessageVideoThumbnail->mime
            ]);

            return $chatMessageVideoThumbnail;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageVideoThumbnail.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param ChatMessageVideoThumbnail $chatMessageVideoThumbnail
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        ChatMessageVideoThumbnail $chatMessageVideoThumbnail
    ) : bool
    {
        try {
            return ChatMessageVideoThumbnail::query()
                ->where('id', '=', $chatMessageVideoThumbnail->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageVideoThumbnail.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array $chatMessageVideosIds
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function deleteByVideosIds(
        array $chatMessageVideosIds
    ) : bool
    {
        try {
            return ChatMessageVideoThumbnail::query()
                ->whereIn('video_id', $chatMessageVideosIds)
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
            return ChatMessageVideoThumbnail::query()
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
