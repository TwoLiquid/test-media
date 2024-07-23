<?php

namespace App\Repositories\Support;

use App\Exceptions\DatabaseException;
use App\Models\MySql\Support\SupportTicketMessageImage;
use App\Repositories\Support\Interfaces\SupportTicketMessageImageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class SupportTicketMessageImageRepository
 *
 * @package App\Repositories\Support
 */
class SupportTicketMessageImageRepository implements SupportTicketMessageImageRepositoryInterface
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
     * SupportTicketMessageImageRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.supportTicketMessageImage.perPage');
        $this->cacheTime = config('repositories.supportTicketMessageImage.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return SupportTicketMessageImage|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?SupportTicketMessageImage
    {
        try {
            return SupportTicketMessageImage::find($id);
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
            return SupportTicketMessageImage::all();
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
            return SupportTicketMessageImage::query()
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
            return SupportTicketMessageImage::query()
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
            return SupportTicketMessageImage::query()
                ->where('message_id', '=', $messageId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageImage.' . __FUNCTION__),
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
            return SupportTicketMessageImage::query()
                ->whereIn('message_id', $messagesIds)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageImage.' . __FUNCTION__),
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
            return SupportTicketMessageImage::query()
                ->where('message_id', '=', $messageId)
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/chatMessageImage.' . __FUNCTION__),
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
     * @return SupportTicketMessageImage|null
     *
     * @throws DatabaseException
     */
    public function store(
        string $messageId,
        string $url,
        float $size,
        string $mime
    ) : ?SupportTicketMessageImage
    {
        try {
            return SupportTicketMessageImage::create([
                'message_id' => $messageId,
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
     * @param SupportTicketMessageImage $supportTicketMessageImage
     * @param string|null $chatMessageId
     * @param string|null $url
     * @param float|null $size
     * @param string|null $mime
     *
     * @return SupportTicketMessageImage
     *
     * @throws DatabaseException
     */
    public function update(
        SupportTicketMessageImage $supportTicketMessageImage,
        ?string $chatMessageId,
        ?string $url,
        ?float $size,
        ?string $mime
    ) : SupportTicketMessageImage
    {
        try {
            $supportTicketMessageImage->update([
                'message_id' => $chatMessageId ?: $supportTicketMessageImage->message_id,
                'url'        => $url ? trim($url) : $supportTicketMessageImage->url,
                'size'       => $size ?: $supportTicketMessageImage->size,
                'mime'       => $mime ? trim($mime) : $supportTicketMessageImage->mime
            ]);

            return $supportTicketMessageImage;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/chat/chatMessageImage.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param SupportTicketMessageImage $supportTicketMessageImage
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        SupportTicketMessageImage $supportTicketMessageImage
    ) : bool
    {
        try {
            return SupportTicketMessageImage::query()
                ->where('id', '=', $supportTicketMessageImage->id)
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
            return SupportTicketMessageImage::query()
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
