<?php

namespace App\Http\Controllers\Api\General\Admin;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\Admin\Interfaces\AdminAvatarControllerInterface;
use App\Http\Requests\Api\General\Admin\Avatar\StoreRequest;
use App\Repositories\Admin\AdminAvatarRepository;
use App\Services\Admin\AdminAvatarService;
use App\Transformers\Api\General\Admin\AdminAvatarTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class AdminAvatarController
 *
 * @package App\Http\Controllers\Api\General\Admin
 */
final class AdminAvatarController extends BaseController implements AdminAvatarControllerInterface
{
    /**
     * @var AdminAvatarRepository
     */
    protected AdminAvatarRepository $adminAvatarRepository;

    /**
     * @var AdminAvatarService
     */
    protected AdminAvatarService $adminAvatarService;

    /**
     * AdminAvatarController constructor
     */
    public function __construct()
    {
        /** @var AdminAvatarRepository adminAvatarRepository */
        $this->adminAvatarRepository = new AdminAvatarRepository();

        /** @var AdminAvatarService adminAvatarService */
        $this->adminAvatarService = new AdminAvatarService();

        parent::__construct();
    }

    /**
     * @param int $authId
     * @param StoreRequest $request
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function store(
        int $authId,
        StoreRequest $request
    ) : JsonResponse
    {
        /**
         * Creating admin avatar
         */
        $adminAvatar = $this->adminAvatarService->createAvatar(
            $authId,
            $request->input('content'),
            $request->input('mime'),
            $request->input('extension')
        );

        return $this->respondWithSuccess(
            $this->transformItem($adminAvatar, new AdminAvatarTransformer),
            trans('validations/api/general/admin/avatar/store.result.success')
        );
    }

    /**
     * @param int $authId
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function destroy(
        int $authId
    ) : JsonResponse
    {
        /**
         * Creating admin avatars
         */
        $adminAvatars = $this->adminAvatarRepository->getByAuthId(
            $authId
        );

        /**
         * Deleting admin avatars
         */
        $this->adminAvatarService->deleteAvatars(
            $adminAvatars
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/admin/avatar/destroy.result.success')
        );
    }
}
