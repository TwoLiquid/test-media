<?php

namespace App\Http\Controllers\Api\Guest\Admin;

use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\Guest\Admin\Interfaces\AdminControllerInterface;
use App\Http\Requests\Api\Guest\Admin\GetForAdminsRequest;
use App\Repositories\Admin\AdminAvatarRepository;
use App\Transformers\Api\Guest\Admin\AdminAvatarTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class AdminController
 *
 * @package App\Http\Controllers\Api\Guest\Admin
 */
final class AdminController extends BaseController implements AdminControllerInterface
{
    /**
     * @var AdminAvatarRepository
     */
    protected AdminAvatarRepository $adminAvatarRepository;

    /**
     * AdminController constructor
     */
    public function __construct()
    {
        /** @var AdminAvatarRepository adminAvatarRepository */
        $this->adminAvatarRepository = new AdminAvatarRepository();

        parent::__construct();
    }

    /**
     * @param GetForAdminsRequest $request
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function getForAdmins(
        GetForAdminsRequest $request
    ) : JsonResponse
    {
        /**
         * Getting admins avatars
         */
        $adminsAvatars = $this->adminAvatarRepository->getByAuthIds(
            $request->input('auth_ids')
        );

        return $this->respondWithSuccess(
            $this->transformCollection($adminsAvatars, new AdminAvatarTransformer),
            trans('validations/api/guest/admin/avatar/getForAdmins.result.success')
        );
    }
}
