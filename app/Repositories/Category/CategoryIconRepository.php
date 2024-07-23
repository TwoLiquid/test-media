<?php

namespace App\Repositories\Category;

use App\Exceptions\DatabaseException;
use App\Models\MySql\CategoryIcon;
use App\Repositories\Category\Interfaces\CategoryIconRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Exception;

/**
 * Class CategoryIconRepository
 *
 * @package App\Repositories\Category
 */
class CategoryIconRepository implements CategoryIconRepositoryInterface
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
     * CategoryIconRepository constructor
     */
    public function __construct()
    {
        $this->perPage = config('repositories.categoryIcon.perPage');
        $this->cacheTime = config('repositories.categoryIcon.cacheTime');
    }

    /**
     * @param int $id
     *
     * @return CategoryIcon|null
     *
     * @throws DatabaseException
     */
    public function findById(
        int $id
    ) : ?CategoryIcon
    {
        try {
            return CategoryIcon::find($id);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/categoryIcon.' . __FUNCTION__),
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
            return CategoryIcon::all();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/categoryIcon.' . __FUNCTION__),
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
        ?int $page
    ) : LengthAwarePaginator
    {
        try {
            return CategoryIcon::query()
                ->orderBy('id', 'desc')
                ->paginate($this->perPage, ['*'], 'page', $page);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/categoryIcon.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $categoryId
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getForCategory(
        int $categoryId
    ) : Collection
    {
        try {
            return CategoryIcon::query()
                ->where('category_id', '=', $categoryId)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/categoryIcon.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param array $categoriesIds
     *
     * @return Collection
     *
     * @throws DatabaseException
     */
    public function getForCategories(
        array $categoriesIds
    ) : Collection
    {
        try {
            return CategoryIcon::query()
                ->whereIn('category_id', $categoriesIds)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/categoryIcon.' . __FUNCTION__),
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
            return CategoryIcon::query()
                ->whereIn('id', $ids)
                ->get();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/categoryIcon.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param int $categoryId
     * @param string $url
     * @param string $mime
     *
     * @return CategoryIcon|null
     *
     * @throws DatabaseException
     */
    public function store(
        int $categoryId,
        string $url,
        string $mime
    ) : ?CategoryIcon
    {
        try {
            return CategoryIcon::create([
                'category_id' => $categoryId,
                'url'         => trim($url),
                'mime'        => trim($mime)
            ]);
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/categoryIcon.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param CategoryIcon $categoryIcon
     * @param int|null $categoryId
     * @param string|null $url
     * @param string|null $mime
     *
     * @return CategoryIcon
     *
     * @throws DatabaseException
     */
    public function update(
        CategoryIcon $categoryIcon,
        ?int $categoryId,
        ?string $url,
        ?string $mime
    ) : CategoryIcon
    {
        try {
            $categoryIcon->update([
                'category_id' => $categoryId ?: $categoryIcon->category_id,
                'url'         => $url ? trim($url) : $categoryIcon->url,
                'mime'        => $mime ? trim($mime) : $categoryIcon->mime
            ]);

            return $categoryIcon;
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/categoryIcon.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }

    /**
     * @param CategoryIcon $categoryIcon
     *
     * @return bool
     *
     * @throws DatabaseException
     */
    public function delete(
        CategoryIcon $categoryIcon
    ) : bool
    {
        try {
            return CategoryIcon::query()
                ->where('id' , '=', $categoryIcon->id)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/categoryIcon.' . __FUNCTION__),
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
            return CategoryIcon::query()
                ->whereIn('id', $ids)
                ->delete();
        } catch (Exception $exception) {
            throw new DatabaseException(
                trans('exceptions/repository/categoryIcon.' . __FUNCTION__),
                $exception->getMessage()
            );
        }
    }
}
