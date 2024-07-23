<?php

namespace App\Repositories\Chat;

use App\Exceptions\DatabaseException;
use App\Models\MySql\Chat\ChatMessageImage;
use App\Repositories\Chat\Interfaces\ChatMessageImageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class ChatMessageImageRepository
 *
 * @package App\Repositories\Chat
 */
class ChatMessageImageRepository implements ChatMessageImageRepositoryInterface
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
     * ChatMessageImageRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.chatMessageImage.perPage');
        $this->cacheTime = config('repositories.chatMessageImage.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return ChatMessageImage|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?ChatMessageImage
    {
        try {
            return ChatMessageImage::find($id);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageImage.' . __FUNCTION__),
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
            return ChatMessageImage::all();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageImage.' . __FUNCTION__),
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
            return ChatMessageImage::query()
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageImage.' . __FUNCTION__),
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
            return ChatMessageImage::query()
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageImage.' . __FUNCTION__),
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
            return ChatMessageImage::query()
                ->where('message_id', '=', $chatMessageId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageImage.' . __FUNCTION__),
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
            return ChatMessageImage::query()
                ->whereIn('message_id', $chatMessagesIds)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageImage.' . __FUNCTION__),
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
            return ChatMessageImage::query()
                ->where('message_id', '=', $chatMessageId)
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param string $chatMessageId
     * @param string $url
     * @param float $size
     * @param string $mime
     *
     * @return ChatMessageImage|null
     *
     * @throws DatabaseException
     */
    public function store(
        string $chatMessageId,
        string $url,
        float $size,
        string $mime
    ) : ?ChatMessageImage
    {
        try {
            return ChatMessageImage::create([
                'message_id' => $chatMessageId,
                'url'        => trim($url),
                'size'       => $size,
                'mime'       => trim($mime)
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param ChatMessageImage $chatMessageImage
     * @param string|null $chatMessageId
     * @param string|null $url
     * @param float|null $size
     * @param string|null $mime
     *
     * @return ChatMessageImage
     *
     * @throws DatabaseException
     */
    public function update(
        ChatMessageImage $chatMessageImage,
        ?string $chatMessageId,
        ?string $url,
        ?float $size,
        ?string $mime
    ) : ChatMessageImage
    {
        try {
            $chatMessageImage->update([
                'message_id' => $chatMessageId ?: $chatMessageImage->message_id,
                'url'        => $url ? trim($url) : $chatMessageImage->url,
                'size'       => $size ?: $chatMessageImage->size,
                'mime'       => $mime ? trim($mime) : $chatMessageImage->mime
            ]);

            return $chatMessageImage;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param ChatMessageImage $chatMessageImage
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        ChatMessageImage $chatMessageImage
    ) : bool
    {
        try {
            return ChatMessageImage::query()
                ->where('id', '=', $chatMessageImage->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageImage.' . __FUNCTION__),
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
            return ChatMessageImage::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
