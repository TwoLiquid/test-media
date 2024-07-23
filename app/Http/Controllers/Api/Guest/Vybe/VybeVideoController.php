<?php

namespace App\Http\Controllers\Api\Guest\Vybe;

use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\Guest\Vybe\Interfaces\VybeVideoControllerInterface;
use App\Http\Requests\Api\Guest\Vybe\Video\ShowManyRequest;
use App\Repositories\Vybe\VybeVideoRepository;
use App\Transformers\Api\Guest\Vybe\VybeVideoTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class VybeVideoController
 *
 * @package App\Http\Controllers\Api\Guest\Vybe
 */
final class VybeVideoController extends BaseController implements VybeVideoControllerInterface
{
    /**
     * @var VybeVideoRepository
     */
    protected VybeVideoRepository $vybeVideoRepository;

    /**
     * VybeVideoController constructor
     */
    public function __construct()
    {
        /** @var VybeVideoRepository vybeVideoRepository */
        $this->vybeVideoRepository = new VybeVideoRepository();

        parent::__construct();
    }

    /**
     * @param ShowManyRequest $request
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function showMany(
        ShowManyRequest $request
    ) : JsonResponse
    {
        /**
         * Getting vybe videos
         */
        $vybeVideos = $this->vybeVideoRepository->getByIds(
            $request->input('vybe_videos_ids')
        );

        return $this->respondWithSuccess(
            $this->transformCollection($vybeVideos, new VybeVideoTransformer),
            trans('validations/api/guest/vybe/video/showMany.result.success')
        );
    }
}
