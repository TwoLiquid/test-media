<?php

namespace App\Http\Controllers\Api\General\Vybe;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\Vybe\Interfaces\VybeVideoControllerInterface;
use App\Http\Requests\Api\General\Vybe\Video\AcceptManyRequest;
use App\Http\Requests\Api\General\Vybe\Video\DeclineManyRequest;
use App\Http\Requests\Api\General\Vybe\Video\DestroyManyRequest;
use App\Http\Requests\Api\General\Vybe\Video\StoreManyRequest;
use App\Repositories\Vybe\VybeVideoRepository;
use App\Services\Vybe\VybeVideoService;
use App\Transformers\Api\General\Vybe\VybeVideoTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class VybeVideoController
 *
 * @package App\Http\Controllers\Api\General\Vybe
 */
final class VybeVideoController extends BaseController implements VybeVideoControllerInterface
{
    /**
     * @var VybeVideoRepository
     */
    protected VybeVideoRepository $vybeVideoRepository;

    /**
     * @var VybeVideoService
     */
    protected VybeVideoService $vybeVideoService;

    /**
     * VybeVideoController constructor
     */
    public function __construct()
    {
        /** @var VybeVideoRepository vybeVideoRepository */
        $this->vybeVideoRepository = new VybeVideoRepository();

        /** @var VybeVideoService vybeVideoService */
        $this->vybeVideoService = new VybeVideoService();

        parent::__construct();
    }

    /**
     * @param StoreManyRequest $request
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function storeMany(
        StoreManyRequest $request
    ) : JsonResponse
    {
        /**
         * Creating vybe videos
         */
        $vybeVideos = $this->vybeVideoService->createVideos(
            $request->input('vybe_videos')
        );

        return $this->respondWithSuccess(
            $this->transformCollection($vybeVideos, new VybeVideoTransformer),
            trans('validations/api/general/vybe/video/storeMany.result.success')
        );
    }

    /**
     * @param AcceptManyRequest $request
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function acceptMany(
        AcceptManyRequest $request
    ) : JsonResponse
    {
        /**
         * Getting vybe videos
         */
        $vybeVideos = $this->vybeVideoRepository->getByIds(
            $request->input('vybe_videos_ids')
        );

        /**
         * Updating vybe videos
         */
        $this->vybeVideoService->acceptVideos(
            $vybeVideos
        );

        return $this->respondWithSuccess(
            $this->transformCollection($vybeVideos, new VybeVideoTransformer),
            trans('validations/api/general/vybe/video/acceptMany.result.success')
        );
    }

    /**
     * @param DeclineManyRequest $request
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function declineMany(
        DeclineManyRequest $request
    ) : JsonResponse
    {
        /**
         * Getting vybe videos
         */
        $vybeVideos = $this->vybeVideoRepository->getByIds(
            $request->input('vybe_videos_ids')
        );

        /**
         * Updating vybe videos
         */
        $this->vybeVideoService->declineVideos(
            $vybeVideos
        );

        return $this->respondWithSuccess(
            $this->transformCollection($vybeVideos, new VybeVideoTransformer),
            trans('validations/api/general/vybe/video/declineMany.result.success')
        );
    }

    /**
     * @param DestroyManyRequest $request
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function destroyMany(
        DestroyManyRequest $request
    ) : JsonResponse
    {
        /**
         * Getting vybe videos
         */
        $vybeVideos = $this->vybeVideoRepository->getByIds(
            $request->input('vybe_videos_ids')
        );

        /**
         * Deleting vybe videos
         */
        $this->vybeVideoService->deleteVideos(
            $vybeVideos
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/vybe/video/destroyMany.result.success')
        );
    }
}
