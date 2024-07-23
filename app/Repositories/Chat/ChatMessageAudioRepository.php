<?php

namespace App\Repositories\Chat;

use App\Exceptions\DatabaseException;
use App\Models\MySql\Chat\ChatMessageAudio;
use App\Repositories\Chat\Interfaces\ChatMessageAudioRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class ChatMessageAudioRepository
 *
 * @package App\Repositories\Chat
 */
class ChatMessageAudioRepository implements ChatMessageAudioRepositoryInterface
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
     * ChatMessageAudioRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.chatMessageAudio.perPage');
        $this->cacheTime = config('repositories.chatMessageAudio.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return ChatMessageAudio|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?ChatMessageAudio
    {
        try {
            return ChatMessageAudio::find($id);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageAudio.' . __FUNCTION__),
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
            return ChatMessageAudio::all();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageAudio.' . __FUNCTION__),
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
            return ChatMessageAudio::query()
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageAudio.' . __FUNCTION__),
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
            return ChatMessageAudio::query()
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageAudio.' . __FUNCTION__),
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
            return ChatMessageAudio::query()
                ->where('message_id', '=', $chatMessageId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageAudio.' . __FUNCTION__),
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
            return ChatMessageAudio::query()
                ->whereIn('message_id', $chatMessagesIds)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageAudio.' . __FUNCTION__),
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
            return ChatMessageAudio::query()
                ->where('message_id', '=', $chatMessageId)
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageAudio.' . __FUNCTION__),
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
     * @return ChatMessageAudio|null
     *
     * @throws DatabaseException
     */
    public function store(
        string $chatMessageId,
        string $url,
        int $duration,
        float $size,
        string $mime
    ) : ?ChatMessageAudio
    {
        try {
            return ChatMessageAudio::create([
                'message_id' => $chatMessageId,
                'url'        => trim($url),
                'duration'   => $duration,
                'size'       => $size,
                'mime'       => trim($mime)
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageAudio.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param ChatMessageAudio $chatMessageAudio
     * @param string|null $chatMessageId
     * @param string|null $url
     * @param int|null $duration
     * @param float|null $size
     * @param string|null $mime
     *
     * @return ChatMessageAudio
     *
     * @throws DatabaseException
     */
    public function update(
        ChatMessageAudio $chatMessageAudio,
        ?string $chatMessageId,
        ?string $url,
        ?int $duration,
        ?float $size,
        ?string $mime
    ) : ChatMessageAudio
    {
        try {
            $chatMessageAudio->update([
                'message_id' => $chatMessageId ?: $chatMessageAudio->id,
                'url'        => $url ? trim($url) : $chatMessageAudio->url,
                'duration'   => $duration ?: $chatMessageAudio->duration,
                'size'       => $size ?: $chatMessageAudio->size,
                'mime'       => $mime ? trim($mime) : $chatMessageAudio->mime
            ]);

            return $chatMessageAudio;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageAudio.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param ChatMessageAudio $chatMessageAudio
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        ChatMessageAudio $chatMessageAudio
    ) : bool
    {
        try {
            return ChatMessageAudio::query()
                ->where('id', '=', $chatMessageAudio->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageAudio.' . __FUNCTION__),
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
            return ChatMessageAudio::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageAudio.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
