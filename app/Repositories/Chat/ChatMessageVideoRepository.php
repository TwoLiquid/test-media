<?php

namespace App\Repositories\Chat;

use App\Exceptions\DatabaseException;
use App\Models\MySql\Chat\ChatMessageVideo;
use App\Repositories\Chat\Interfaces\ChatMessageVideoRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class ChatMessageVideoRepository
 *
 * @package App\Repositories\Chat
 */
class ChatMessageVideoRepository implements ChatMessageVideoRepositoryInterface
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
     * Cache usage
     *
     * @var bool
     */
    protected bool $caching;

    /**
     * ChatMessageVideoRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.chatMessageVideo.perPage');
        $this->cacheTime = config('repositories.chatMessageVideo.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return ChatMessageVideo|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?ChatMessageVideo
    {
        try {
            return ChatMessageVideo::query()
                ->with([
                    'thumbnail'
                ])
                ->find($id);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageVideo.' . __FUNCTION__),
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
            return ChatMessageVideo::query()
                ->with([
                    'thumbnail'
                ])
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageVideo.' . __FUNCTION__),
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
            return ChatMessageVideo::query()
                ->with([
                    'thumbnail'
                ])
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageVideo.' . __FUNCTION__),
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
            return ChatMessageVideo::query()
                ->with([
                    'thumbnail'
                ])
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param string $chatMessageId
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getForChatMessage(
        string $chatMessageId
    ) : Collection
    {
        try {
            return ChatMessageVideo::query()
                ->with([
                    'thumbnail'
                ])
                ->where('message_id', '=', $chatMessageId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array $chatMessagesIds
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getForChatMessages(
        array $chatMessagesIds
    ) : Collection
    {
        try {
            return ChatMessageVideo::query()
                ->with([
                    'thumbnail'
                ])
                ->whereIn('message_id', $chatMessagesIds)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param string $chatMessageId
     * @param array $ids
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getForChatMessageByIds(
        string $chatMessageId,
        array $ids
    ) : Collection
    {
        try {
            return ChatMessageVideo::query()
                ->where('message_id', '=', $chatMessageId)
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param string $chatMessageId
     * @param string $url
     * @param int $duration
     * @param float $size
     * @param string $mime
     *
     * @return ChatMessageVideo|null
     *
     * @throws DatabaseException
     */
    public function store(
        string $chatMessageId,
        string $url,
        int $duration,
        float $size,
        string $mime
    ) : ?ChatMessageVideo
    {
        try {
            return ChatMessageVideo::create([
                'message_id' => $chatMessageId,
                'url'        => trim($url),
                'duration'   => $duration,
                'size'       => $size,
                'mime'       => trim($mime)
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param ChatMessageVideo $chatMessageVideo
     * @param string|null $chatMessageId
     * @param string|null $url
     * @param int|null $duration
     * @param float|null $size
     * @param string|null $mime
     *
     * @return ChatMessageVideo
     *
     * @throws DatabaseException
     */
    public function update(
        ChatMessageVideo $chatMessageVideo,
        ?string $chatMessageId,
        ?string $url,
        ?int $duration,
        ?float $size,
        ?string $mime
    ) : ChatMessageVideo
    {
        try {
            $chatMessageVideo->update([
                'message_id' => $chatMessageId ?: $chatMessageVideo->message_id,
                'url'        => $url ? trim($url) : $chatMessageVideo->url,
                'duration'   => $duration ?: $chatMessageVideo->duration,
                'size'       => $size ?: $chatMessageVideo->size,
                'mime'       => $mime ? trim($mime) : $chatMessageVideo->mime
            ]);

            return $chatMessageVideo;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param ChatMessageVideo $chatMessageVideo
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        ChatMessageVideo $chatMessageVideo
    ) : bool
    {
        try {
            return ChatMessageVideo::query()
                ->where('id', '=', $chatMessageVideo->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageVideo.' . __FUNCTION__),
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
            return ChatMessageVideo::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
