<?php

namespace App\Repositories\Support;

use App\Exceptions\DatabaseException;
use App\Models\MySql\Support\SupportTicketMessageVideo;
use App\Repositories\Support\Interfaces\SupportTicketMessageVideoRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class SupportTicketMessageVideoRepository
 *
 * @package App\Repositories\Support
 */
class SupportTicketMessageVideoRepository implements SupportTicketMessageVideoRepositoryInterface
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
     * SupportTicketMessageVideoRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.supportTicketMessageVideo.perPage');
        $this->cacheTime = config('repositories.supportTicketMessageVideo.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return SupportTicketMessageVideo|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?SupportTicketMessageVideo
    {
        try {
            return SupportTicketMessageVideo::query()
                ->with([
                    'thumbnail'
                ])
                ->find($id);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageVideo.' . __FUNCTION__),
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
            return SupportTicketMessageVideo::query()
                ->with([
                    'thumbnail'
                ])
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageVideo.' . __FUNCTION__),
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
            return SupportTicketMessageVideo::query()
                ->with([
                    'thumbnail'
                ])
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageVideo.' . __FUNCTION__),
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
            return SupportTicketMessageVideo::query()
                ->with([
                    'thumbnail'
                ])
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageVideo.' . __FUNCTION__),
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
            return SupportTicketMessageVideo::query()
                ->with([
                    'thumbnail'
                ])
                ->where('message_id', '=', $messageId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageVideo.' . __FUNCTION__),
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
            return SupportTicketMessageVideo::query()
                ->with([
                    'thumbnail'
                ])
                ->whereIn('message_id', $messagesIds)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageVideo.' . __FUNCTION__),
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
            return SupportTicketMessageVideo::query()
                ->where('message_id', '=', $messageId)
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageVideo.' . __FUNCTION__),
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
     * @return SupportTicketMessageVideo|null
     *
     * @throws DatabaseException
     */
    public function store(
        string $messageId,
        string $url,
        int $duration,
        float $size,
        string $mime
    ) : ?SupportTicketMessageVideo
    {
        try {
            return SupportTicketMessageVideo::create([
                'message_id' => $messageId,
                'url'        => trim($url),
                'duration'   => $duration,
                'size'       => $size,
                'mime'       => trim($mime)
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param SupportTicketMessageVideo $supportTicketMessageVideo
     * @param string|null $chatMessageId
     * @param string|null $url
     * @param int|null $duration
     * @param float|null $size
     * @param string|null $mime
     *
     * @return SupportTicketMessageVideo
     *
     * @throws DatabaseException
     */
    public function update(
        SupportTicketMessageVideo $supportTicketMessageVideo,
        ?string $chatMessageId,
        ?string $url,
        ?int $duration,
        ?float $size,
        ?string $mime
    ) : SupportTicketMessageVideo
    {
        try {
            $supportTicketMessageVideo->update([
                'message_id' => $chatMessageId ?: $supportTicketMessageVideo->message_id,
                'url'        => $url ? trim($url) : $supportTicketMessageVideo->url,
                'duration'   => $duration ?: $supportTicketMessageVideo->duration,
                'size'       => $size ?: $supportTicketMessageVideo->size,
                'mime'       => $mime ? trim($mime) : $supportTicketMessageVideo->mime
            ]);

            return $supportTicketMessageVideo;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param SupportTicketMessageVideo $supportTicketMessageVideo
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        SupportTicketMessageVideo $supportTicketMessageVideo
    ) : bool
    {
        try {
            return SupportTicketMessageVideo::query()
                ->where('id', '=', $supportTicketMessageVideo->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageVideo.' . __FUNCTION__),
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
            return SupportTicketMessageVideo::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageVideo.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
