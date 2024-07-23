<?php

namespace App\Http\Controllers\Api\Guest\Vybe;

use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\Guest\Vybe\Interfaces\VybeImageControllerInterface;
use App\Http\Requests\Api\Guest\Vybe\Image\ShowManyRequest;
use App\Repositories\Vybe\VybeImageRepository;
use App\Transformers\Api\Guest\Vybe\VybeImageTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class VybeImageController
 *
 * @package App\Http\Controllers\Api\Guest\Vybe
 */
final class VybeImageController extends BaseController implements VybeImageControllerInterface
{
    /**
     * @var VybeImageRepository
     */
    protected VybeImageRepository $vybeImageRepository;

    /**
     * VybeImageController constructor
     */
    public function __construct()
    {
        /** @var VybeImageRepository vybeImageRepository */
        $this->vybeImageRepository = new VybeImageRepository();

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
         * Getting vybe images
         */
        $vybeImages = $this->vybeImageRepository->getByIds(
            $request->input('vybe_images_ids')
        );

        return $this->respondWithSuccess(
            $this->transformCollection($vybeImages, new VybeImageTransformer),
            trans('validations/api/guest/vybe/image/showMany.result.success')
        );
    }
}
