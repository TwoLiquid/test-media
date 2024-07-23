<?php

namespace App\Support\Response\Services\User\UserSticker;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class UserStickerCategoryCollectionResponse
 *
 * @property Collection $categories
 *
 * @package App\Support\Response\Services\User\UserSticker
 */
class UserStickerCategoryCollectionResponse extends BaseResponse
{
    /**
     * @var Collection
     */
    public Collection $categories;

    /**
     * UserStickerCategoryCollectionResponse constructor
     *
     * @param array $categories
     * @param string|null $message
     */
    public function __construct(
        array $categories,
        ?string $message
    )
    {
        $this->categories = new Collection();

        /** @var object $category */
        foreach ($categories as $category) {
            $this->categories->push(
                new UserStickerCategoryResponse(
                    $category,
                    null
                )
            );
        }

        parent::__construct($message);
    }
}
