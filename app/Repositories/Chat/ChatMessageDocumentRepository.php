<?php

namespace App\Repositories\Chat;

use App\Exceptions\DatabaseException;
use App\Models\MySql\Chat\ChatMessageDocument;
use App\Repositories\Chat\Interfaces\ChatMessageDocumentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class ChatMessageDocumentRepository
 *
 * @package App\Repositories\Chat
 */
class ChatMessageDocumentRepository implements ChatMessageDocumentRepositoryInterface
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
     * ChatMessageDocumentRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.chatMessageDocument.perPage');
        $this->cacheTime = config('repositories.chatMessageDocument.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return ChatMessageDocument|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?ChatMessageDocument
    {
        try {
            return ChatMessageDocument::find($id);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageDocument.' . __FUNCTION__),
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
            return ChatMessageDocument::all();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageDocument.' . __FUNCTION__),
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
            return ChatMessageDocument::query()
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageDocument.' . __FUNCTION__),
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
            return ChatMessageDocument::query()
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageDocument.' . __FUNCTION__),
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
            return ChatMessageDocument::query()
                ->where('message_id', '=', $chatMessageId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageDocument.' . __FUNCTION__),
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
            return ChatMessageDocument::query()
                ->whereIn('message_id', $chatMessagesIds)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageDocument.' . __FUNCTION__),
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
            return ChatMessageDocument::query()
                ->where('message_id', '=', $chatMessageId)
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageDocument.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param string $chatMessageId
     * @param string $url
     * @param string $originalName
     * @param float $size
     * @param string $mime
     *
     * @return ChatMessageDocument|null
     *
     * @throws DatabaseException
     */
    public function store(
        string $chatMessageId,
        string $url,
        string $originalName,
        float $size,
        string $mime
    ) : ?ChatMessageDocument
    {
        try {
            return ChatMessageDocument::create([
                'message_id'    => $chatMessageId,
                'url'           => trim($url),
                'original_name' => trim($originalName),
                'size'          => $size,
                'mime'          => trim($mime)
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageDocument.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param ChatMessageDocument $chatMessageDocument
     * @param string|null $chatMessageId
     * @param string|null $url
     * @param string|null $originalName
     * @param float|null $size
     * @param string|null $mime
     *
     * @return ChatMessageDocument
     *
     * @throws DatabaseException
     */
    public function update(
        ChatMessageDocument $chatMessageDocument,
        ?string $chatMessageId,
        ?string $url,
        ?string $originalName,
        ?float $size,
        ?string $mime
    ) : ChatMessageDocument
    {
        try {
            $chatMessageDocument->update([
                'message_id'    => $chatMessageId ?: $chatMessageDocument->message_id,
                'url'           => $url ? trim($url) : $chatMessageDocument->url,
                'original_name' => $originalName ?: $chatMessageDocument->original_name,
                'size'          => $size ?: $chatMessageDocument->size,
                'mime'          => $mime ? trim($mime) : $chatMessageDocument->mime
            ]);

            return $chatMessageDocument;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageDocument.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param ChatMessageDocument $chatMessageDocument
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        ChatMessageDocument $chatMessageDocument
    ) : bool
    {
        try {
            return ChatMessageDocument::query()
                ->where('id', '=', $chatMessageDocument->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageDocument.' . __FUNCTION__),
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
            return ChatMessageDocument::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageDocument.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
