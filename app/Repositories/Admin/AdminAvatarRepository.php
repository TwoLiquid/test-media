<?php

namespace App\Repositories\Admin;

use App\Exceptions\DatabaseException;
use App\Models\MySql\AdminAvatar;
use App\Repositories\Admin\Interfaces\AdminAvatarRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

/**
 * Class AdminAvatarRepository
 *
 * @package App\Repositories\Admin
 */
class AdminAvatarRepository implements AdminAvatarRepositoryInterface
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
     * AdminAvatarRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.adminAvatar.perPage');
        $this->cacheTime = config('repositories.adminAvatar.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return AdminAvatar|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?AdminAvatar
    {
        try {
            return AdminAvatar::find($id);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/adminAvatar.' . __FUNCTION__),
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
            return AdminAvatar::all();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/adminAvatar.' . __FUNCTION__),
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
            return AdminAvatar::query()
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/adminAvatar.' . __FUNCTION__),
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
            return AdminAvatar::query()
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/adminAvatar.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $authId
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getByAuthId(
        int $authId
    ) : Collection
    {
        try {
            return AdminAvatar::query()
                ->where('auth_id', '=', $authId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/adminAvatar.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array $authIds
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getByAuthIds(
        array $authIds
    ) : Collection
    {
        try {
            return AdminAvatar::query()
                ->whereIn('auth_id', $authIds)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/adminAvatar.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $authId
     * @param string $url
     * @param string $mime
     *
     * @return AdminAvatar|null
     *
     * @throws DatabaseException
     */
    public function store(
        int $authId,
        string $url,
        string $mime
    ) : ?AdminAvatar
    {
        try {
            return AdminAvatar::create([
                'auth_id' => $authId,
                'url'     => trim($url),
                'mime'    => trim($mime)
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/adminAvatar.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param AdminAvatar $adminAvatar
     * @param int|null $authId
     * @param string|null $url
     * @param string|null $mime
     *
     * @return AdminAvatar
     *
     * @throws DatabaseException
     */
    public function update(
        AdminAvatar $adminAvatar,
        ?int $authId,
        ?string $url,
        ?string $mime
    ) : AdminAvatar
    {
        try {
            $adminAvatar->update([
                'auth_id' => $authId ?: $adminAvatar->auth_id,
                'url'     => $url ? trim($url) : $adminAvatar->url,
                'mime'    => $mime ? trim($mime) : $adminAvatar->mime
            ]);

            return $adminAvatar;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/adminAvatar.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param AdminAvatar $adminAvatar
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        AdminAvatar $adminAvatar
    ) : bool
    {
        try {
            return AdminAvatar::query()
                ->where('id', '=', $adminAvatar->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/adminAvatar.' . __FUNCTION__),
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
            return AdminAvatar::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/adminAvatar.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
