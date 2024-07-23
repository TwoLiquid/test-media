<?php

namespace App\Services\Category\Interfaces;

use App\Models\MySql\CategoryIcon;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface CategoryIconServiceInterface
 *
 * @package App\Services\Category\Interfaces
 */
interface CategoryIconServiceInterface
{
    /**
     * This method provides creating data
     *
     * @param string $categoryId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return CategoryIcon
     */
    public function createIcon(
        string $categoryId,
        string $content,
        string $mime,
        string $extension
    ) : CategoryIcon;

    /**
     * This method provides creating data
     *
     * @param string $categoryId
     * @param array $categoryIconFiles
     *
     * @return Collection
     */
    public function createIcons(
        string $categoryId,
        array $categoryIconFiles
    ) : Collection;

    /**
     * This method provides deleting data
     *
     * @param CategoryIcon $categoryIcon
     *
     * @return bool
     */
    public function deleteIcon(
        CategoryIcon $categoryIcon
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $categoryIcons
     *
     * @return bool
     */
    public function deleteIcons(
        Collection $categoryIcons
    ) : bool;
}
