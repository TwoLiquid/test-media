<?php

namespace App\Services\User;

use App\Exceptions\BaseException;
use App\Services\User\Interfaces\UserStickerServiceInterface;
use App\Support\Response\Services\User\UserSticker\UserStickerCategoryCollectionResponse;
use App\Support\Response\Services\User\UserSticker\UserStickerCollectionResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Collection;
use Exception;

/**
 * Class UserStickerService
 *
 * @package App\Services\User
 */
final class UserStickerService implements UserStickerServiceInterface
{
    /**
     * Tenor API url
     *
     * @var string
     */
    protected string $apiUrl;

    /**
     * Tenor API key
     *
     * @var string
     */
    protected string $apiKey;

    /**
     * Guzzle http requests client
     *
     * @var Client
     */
    protected Client $client;

    /**
     * UserStickerService constructor
     */
    public function __construct()
    {
        /**
         * Api parameters initialization
         */
        $this->apiUrl = config('services.tenor.url');
        $this->apiKey = config('services.tenor.key');
        $this->client = new Client();
    }

    /**
     * @param string $type
     *
     * @return UserStickerCategoryCollectionResponse
     *
     * @throws BaseException
     * @throws GuzzleException
     */
    public function getCategories(
        string $type
    ) : UserStickerCategoryCollectionResponse
    {
        try {
            $response = $this->client->request(
                'GET',
                $this->apiUrl . 'categories', [
                    'query' => [
                        'key'  => $this->apiKey,
                        'type' => $type
                    ]
                ]
            );

            $responseData = json_decode(
                $response->getBody()->getContents()
            );

            return new UserStickerCategoryCollectionResponse(
                $responseData->tags,
                null
            );
        } catch (Exception $exception) {
            throw new BaseException(
                trans('exceptions/service/user/userSticker.' . __FUNCTION__),
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }

    /**
     * @param int $limit
     * @param string|null $next
     *
     * @return UserStickerCollectionResponse
     *
     * @throws BaseException
     * @throws GuzzleException
     */
    public function getFeatured(
        int $limit,
        ?string $next
    ) : UserStickerCollectionResponse
    {
        try {
            $response = $this->client->request(
                'GET',
                $this->apiUrl . 'featured', [
                    'query' => [
                        'key'           => $this->apiKey,
                        'contentfilter' => 'high',
                        'media_filter'  => 'gif,tinygif,mp4,tinymp4',
                        'limit'         => $limit,
                        'pos'           => $next
                    ]
                ]
            );

            $responseData = json_decode(
                $response->getBody()->getContents()
            );

            return new UserStickerCollectionResponse(
                $responseData->results,
                $responseData->next ?? null,
                null
            );
        } catch (Exception $exception) {
            throw new BaseException(
                trans('exceptions/service/user/userSticker.' . __FUNCTION__),
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }

    /**
     * @param string $query
     * @param int $limit
     * @param string|null $next
     *
     * @return UserStickerCollectionResponse
     *
     * @throws BaseException
     * @throws GuzzleException
     */
    public function searchByQuery(
        string $query,
        int $limit,
        ?string $next
    ) : UserStickerCollectionResponse
    {
        try {
            $response = $this->client->request(
                'GET',
                $this->apiUrl . 'search', [
                    'query' => [
                        'key'           => $this->apiKey,
                        'contentfilter' => 'high',
                        'media_filter'  => 'gif,tinygif,mp4,tinymp4',
                        'q'             => $query,
                        'limit'         => $limit,
                        'pos'           => $next
                    ]
                ]
            );

            $responseData = json_decode(
                $response->getBody()->getContents()
            );

            return new UserStickerCollectionResponse(
                $responseData->results,
                $responseData->next ?? null,
                null
            );
        } catch (Exception $exception) {
            throw new BaseException(
                trans('exceptions/service/user/userSticker.' . __FUNCTION__),
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }

    /**
     * @param Collection $userFavoriteStickers
     *
     * @return UserStickerCollectionResponse
     *
     * @throws BaseException
     * @throws GuzzleException
     */
    public function getFavorites(
        Collection $userFavoriteStickers
    ) : UserStickerCollectionResponse
    {
        try {
            $response = $this->client->request(
                'GET',
                $this->apiUrl . 'posts', [
                    'query' => [
                        'key'          => $this->apiKey,
                        'media_filter' => 'gif,tinygif,mp4,tinymp4',
                        'ids'          => implode(',', $userFavoriteStickers->pluck('external_id')
                            ->values()
                            ->toArray()
                        )
                    ]
                ]
            );

            $responseData = json_decode(
                $response->getBody()->getContents()
            );

            return new UserStickerCollectionResponse(
                $responseData->results,
                null,
                null
            );
        } catch (Exception $exception) {
            throw new BaseException(
                trans('exceptions/service/user/userSticker.' . __FUNCTION__),
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }

    /**
     * @param array $ids
     *
     * @return UserStickerCollectionResponse
     *
     * @throws BaseException
     * @throws GuzzleException
     */
    public function getByIds(
        array $ids
    ) : UserStickerCollectionResponse
    {
        try {
            $response = $this->client->request(
                'GET',
                $this->apiUrl . 'posts', [
                    'query' => [
                        'key'          => $this->apiKey,
                        'media_filter' => 'gif,tinygif,mp4,tinymp4',
                        'ids'          => implode(',', $ids)
                    ]
                ]
            );

            $responseData = json_decode(
                $response->getBody()->getContents()
            );

            return new UserStickerCollectionResponse(
                $responseData->results,
                null,
                null
            );
        } catch (Exception $exception) {
            throw new BaseException(
                trans('exceptions/service/user/userSticker.' . __FUNCTION__),
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }
}
