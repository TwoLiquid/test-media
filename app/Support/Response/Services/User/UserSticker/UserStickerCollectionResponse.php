<?php

namespace App\Support\Response\Services\User\UserSticker;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class UserStickerCollectionResponse
 *
 * @property Collection $stickers
 * @property string $next
 *
 * @package App\Support\Response\Services\User\UserSticker
 */
class UserStickerCollectionResponse extends BaseResponse
{
    /**
     * @var Collection
     */
    public Collection $stickers;

    /**
     * @var string|null
     */
    public ?string $next;

    /**
     * UserStickerCollectionResponse constructor
     *
     * @param array $stickers
     * @param string|null $next
     * @param string|null $message
     */
    public function __construct(
        array $stickers,
        ?string $next,
        ?string $message
    )
    {
        $this->stickers = new Collection();
        $this->next = $next;

        /** @var object $sticker */
        foreach ($stickers as $sticker) {
            $this->stickers->push(
                new UserStickerResponse(
                    $sticker,
                    null
                )
            );
        }

        parent::__construct($message);
    }
}
