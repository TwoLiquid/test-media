<?php

namespace App\Services\Category;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\CategoryIcon;
use App\Repositories\Category\CategoryIconRepository;
use App\Services\Category\Interfaces\CategoryIconServiceInterface;
use App\Services\File\FileService;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class CategoryIconService
 *
 * @package App\Services\Category
 */
final class CategoryIconService extends FileService implements CategoryIconServiceInterface
{
    /**
     * @var string
     */
    protected const ENVIRONMENT = 'public';

    /**
     * Icon files storage name
     */
    protected const FOLDER = 'category_icons';

    /**
     * @var CategoryIconRepository
     */
    protected CategoryIconRepository $categoryIconRepository;

    /**
     * CategoryIconService constructor
     */
    public function __construct()
    {
        /** @var CategoryIconRepository categoryIconRepository */
        $this->categoryIconRepository = new CategoryIconRepository();
    }

    /**
     * @param string $categoryId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return CategoryIcon
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createIcon(
        string $categoryId,
        string $content,
        string $mime,
        string $extension
    ) : CategoryIcon
    {
        /**
         * Uploading file
         */
        $filePath = $this->uploadFile(
            $content,
            $extension,
            self::FOLDER
        );

        /**
         * Creating category icon
         */
        return $this->categoryIconRepository->store(
            $categoryId,
            $filePath,
            $mime
        );
    }

    /**
     * @param string $categoryId
     * @param array $categoryIconFiles
     *
     * @return Collection
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createIcons(
        string $categoryId,
        array $categoryIconFiles
    ) : Collection
    {
        /**
         * Preparing a category icon collection
         */
        $categoryIcons = new Collection();

        /** @var array $categoryIconFile */
        foreach ($categoryIconFiles as $categoryIconFile) {

            /**
             * Pushing created category icon to response
             */
            $categoryIcons->push(
                $this->createIcon(
                    $categoryId,
                    $categoryIconFile['content'],
                    $categoryIconFile['mime'],
                    $categoryIconFile['extension']
                )
            );
        }

        return $categoryIcons;
    }

    /**
     * @param CategoryIcon $categoryIcon
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteIcon(
        CategoryIcon $categoryIcon
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $categoryIcon->url
        );

        /**
         * Deleting category icon
         */
        return $this->categoryIconRepository->delete(
            $categoryIcon
        );
    }

    /**
     * @param Collection $categoryIcons
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteIcons(
        Collection $categoryIcons
    ) : bool
    {
        /** @var CategoryIcon $categoryIcon */
        foreach ($categoryIcons as $categoryIcon) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $categoryIcon->url
            );
        }

        /**
         * Deleting category icons
         */
        return $this->categoryIconRepository->deleteByIds(
            $categoryIcons->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
