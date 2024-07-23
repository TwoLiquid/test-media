<?php

namespace App\Repositories\Support;

use App\Exceptions\DatabaseException;
use App\Models\MySql\Support\SupportTicketMessageAudio;
use App\Repositories\Support\Interfaces\SupportTicketMessageAudioRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class SupportTicketMessageAudioRepository
 *
 * @package App\Repositories\Support
 */
class SupportTicketMessageAudioRepository implements SupportTicketMessageAudioRepositoryInterface
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
     * SupportTicketMessageAudioRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.supportTicketMessageAudio.perPage');
        $this->cacheTime = config('repositories.supportTicketMessageAudio.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return SupportTicketMessageAudio|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?SupportTicketMessageAudio
    {
        try {
            return SupportTicketMessageAudio::find($id);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageAudio.' . __FUNCTION__),
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
            return SupportTicketMessageAudio::all();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageAudio.' . __FUNCTION__),
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
            return SupportTicketMessageAudio::query()
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageAudio.' . __FUNCTION__),
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
            return SupportTicketMessageAudio::query()
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageAudio.' . __FUNCTION__),
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
            return SupportTicketMessageAudio::query()
                ->where('message_id', '=', $messageId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageAudio.' . __FUNCTION__),
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
            return SupportTicketMessageAudio::query()
                ->whereIn('message_id', $messagesIds)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageAudio.' . __FUNCTION__),
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
            return SupportTicketMessageAudio::query()
                ->where('message_id', '=', $messageId)
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageAudio.' . __FUNCTION__),
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
     * @return SupportTicketMessageAudio|null
     *
     * @throws DatabaseException
     */
    public function store(
        string $messageId,
        string $url,
        int $duration,
        float $size,
        string $mime
    ) : ?SupportTicketMessageAudio
    {
        try {
            return SupportTicketMessageAudio::create([
                'message_id' => $messageId,
                'url'        => trim($url),
                'duration'   => $duration,
                'size'       => $size,
                'mime'       => trim($mime)
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageAudio.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param SupportTicketMessageAudio $supportTicketMessageAudio
     * @param string|null $messageId
     * @param string|null $url
     * @param int|null $duration
     * @param float|null $size
     * @param string|null $mime
     *
     * @return SupportTicketMessageAudio
     *
     * @throws DatabaseException
     */
    public function update(
        SupportTicketMessageAudio $supportTicketMessageAudio,
        ?string $messageId,
        ?string $url,
        ?int $duration,
        ?float $size,
        ?string $mime
    ) : SupportTicketMessageAudio
    {
        try {
            $supportTicketMessageAudio->update([
                'message_id' => $messageId ?: $supportTicketMessageAudio->id,
                'url'        => $url ? trim($url) : $supportTicketMessageAudio->url,
                'duration'   => $duration ?: $supportTicketMessageAudio->duration,
                'size'       => $size ?: $supportTicketMessageAudio->size,
                'mime'       => $mime ? trim($mime) : $supportTicketMessageAudio->mime
            ]);

            return $supportTicketMessageAudio;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageAudio.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param SupportTicketMessageAudio $supportTicketMessageAudio
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        SupportTicketMessageAudio $supportTicketMessageAudio
    ) : bool
    {
        try {
            return SupportTicketMessageAudio::query()
                ->where('id', '=', $supportTicketMessageAudio->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageAudio.' . __FUNCTION__),
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
            return SupportTicketMessageAudio::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/support/supportTicketMessageAudio.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
