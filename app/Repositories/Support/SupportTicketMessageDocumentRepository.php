<?php

namespace App\Repositories\Support;

use App\Exceptions\DatabaseException;
use App\Models\MySql\Support\SupportTicketMessageDocument;
use App\Repositories\Support\Interfaces\SupportTicketMessageDocumentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class SupportTicketMessageDocumentRepository
 *
 * @package App\Repositories\Support
 */
class SupportTicketMessageDocumentRepository implements SupportTicketMessageDocumentRepositoryInterface
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
     * SupportTicketMessageDocumentRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.supportTicketMessageDocument.perPage');
        $this->cacheTime = config('repositories.supportTicketMessageDocument.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return SupportTicketMessageDocument|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?SupportTicketMessageDocument
    {
        try {
            return SupportTicketMessageDocument::find($id);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageDocument.' . __FUNCTION__),
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
            return SupportTicketMessageDocument::all();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageDocument.' . __FUNCTION__),
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
            return SupportTicketMessageDocument::query()
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageDocument.' . __FUNCTION__),
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
            return SupportTicketMessageDocument::query()
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageDocument.' . __FUNCTION__),
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
            return SupportTicketMessageDocument::query()
                ->where('message_id', '=', $messageId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageDocument.' . __FUNCTION__),
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
            return SupportTicketMessageDocument::query()
                ->whereIn('message_id', $messagesIds)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageDocument.' . __FUNCTION__),
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
            return SupportTicketMessageDocument::query()
                ->where('message_id', '=', $messageId)
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageDocument.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param string $messageId
     * @param string $url
     * @param string $originalName
     * @param float $size
     * @param string $mime
     *
     * @return SupportTicketMessageDocument|null
     *
     * @throws DatabaseException
     */
    public function store(
        string $messageId,
        string $url,
        string $originalName,
        float $size,
        string $mime
    ) : ?SupportTicketMessageDocument
    {
        try {
            return SupportTicketMessageDocument::create([
                'message_id'    => $messageId,
                'url'           => trim($url),
                'original_name' => trim($originalName),
                'size'          => $size,
                'mime'          => trim($mime)
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageDocument.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param SupportTicketMessageDocument $supportTicketMessageDocument
     * @param string|null $messageId
     * @param string|null $url
     * @param string|null $originalName
     * @param float|null $size
     * @param string|null $mime
     *
     * @return SupportTicketMessageDocument
     *
     * @throws DatabaseException
     */
    public function update(
        SupportTicketMessageDocument $supportTicketMessageDocument,
        ?string $messageId,
        ?string $url,
        ?string $originalName,
        ?float $size,
        ?string $mime
    ) : SupportTicketMessageDocument
    {
        try {
            $supportTicketMessageDocument->update([
                'message_id'    => $messageId ?: $supportTicketMessageDocument->message_id,
                'url'           => $url ? trim($url) : $supportTicketMessageDocument->url,
                'original_name' => $originalName ?: $supportTicketMessageDocument->original_name,
                'size'          => $size ?: $supportTicketMessageDocument->size,
                'mime'          => $mime ? trim($mime) : $supportTicketMessageDocument->mime
            ]);

            return $supportTicketMessageDocument;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageDocument.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param SupportTicketMessageDocument $supportTicketMessageDocument
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        SupportTicketMessageDocument $supportTicketMessageDocument
    ) : bool
    {
        try {
            return SupportTicketMessageDocument::query()
                ->where('id', '=', $supportTicketMessageDocument->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageDocument.' . __FUNCTION__),
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
            return SupportTicketMessageDocument::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageDocument.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
