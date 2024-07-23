<?php

namespace App\Repositories\Category\Interfaces;

use App\Models\MySql\CategoryIcon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface CategoryIconRepositoryInterface
 *
 * @package App\Repositories\Category\Interfaces
 */
interface CategoryIconRepositoryInterface
{
    /**
     * This method provides finding a single row
     * with an eloquent model by primary key
     *
     * @param int $id
     *
     * @return CategoryIcon|null
     */
    public function findById(
        int $id
    ) : ?CategoryIcon;

    /**
     * This method provides getting all rows
     * with an eloquent model
     *
     * @return Collection
     */
    public function getAll() : Collection;

    /**
     * This method provides getting all rows
     * with an eloquent model with pagination
     *
     * @param int|null $page
     *
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(
        ?int $page
    ) : LengthAwarePaginator;

    /**
     * This method provides getting all rows
     * with an eloquent model by certain query
     *
     * @param int $categoryId
     *
     * @return Collection
     */
    public function getForCategory(
        int $categoryId
    ) : Collection;

    /**
     * This method provides getting rows
     * with an eloquent model by certain query
     *
     * @param array $categoriesIds
     *
     * @return Collection
     */
    public function getForCategories(
        array $categoriesIds
    ) : Collection;

    /**
     * This method provides getting rows
     * with an eloquent model by certain query
     *
     * @param array $ids
     *
     * @return Collection
     */
    public function getByIds(
        array $ids
    ) : Collection;

    /**
     * This method provides creating a new row
     * with an eloquent model
     *
     * @param int $categoryId
     * @param string $url
     * @param string $mime
     *
     * @return CategoryIcon|null
     */
    public function store(
        int $categoryId,
        string $url,
        string $mime
    ) : ?CategoryIcon;

    /**
     * This method provides updating existing row
     * with an eloquent model
     *
     * @param CategoryIcon $categoryIcon
     * @param int|null $categoryId
     * @param string|null $url
     * @param string|null $mime
     *
     * @return CategoryIcon
     */
    public function update(
        CategoryIcon $categoryIcon,
        ?int $categoryId,
        ?string $url,
        ?string $mime
    ) : CategoryIcon;

    /**
     * This method provides deleting existing row
     * with an eloquent model
     *
     * @param CategoryIcon $categoryIcon
     *
     * @return bool
     */
    public function delete(
        CategoryIcon $categoryIcon
    ) : bool;

    /**
     * This method provides deleting existing rows
     * with an eloquent model
     *
     * @param array $ids
     *
     * @return bool
     */
    public function deleteByIds(
        array $ids
    ) : bool;
}
