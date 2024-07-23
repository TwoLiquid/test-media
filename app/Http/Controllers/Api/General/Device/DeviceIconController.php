<?php

namespace App\Http\Controllers\Api\General\Device;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\Device\Interfaces\DeviceIconControllerInterface;
use App\Http\Requests\Api\General\Device\Icon\StoreRequest;
use App\Repositories\Device\DeviceIconRepository;
use App\Services\Device\DeviceIconService;
use App\Transformers\Api\General\Device\DeviceIconTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class DeviceIconController
 *
 * @package App\Http\Controllers\Api\General\Device
 */
final class DeviceIconController extends BaseController implements DeviceIconControllerInterface
{
    /**
     * @var DeviceIconRepository
     */
    protected DeviceIconRepository $deviceIconRepository;

    /**
     * @var DeviceIconService
     */
    protected DeviceIconService $deviceIconService;

    /**
     * DeviceIconController constructor
     */
    public function __construct()
    {
        /** @var DeviceIconRepository deviceIconRepository */
        $this->deviceIconRepository = new DeviceIconRepository();

        /** @var DeviceIconService deviceIconService */
        $this->deviceIconService = new DeviceIconService();

        parent::__construct();
    }

    /**
     * @param int $deviceId
     * @param StoreRequest $request
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function store(
        int $deviceId,
        StoreRequest $request
    ) : JsonResponse
    {
        /**
         * Creating device icon
         */
        $deviceIcon = $this->deviceIconService->createIcon(
            $deviceId,
            $request->input('content'),
            $request->input('mime'),
            $request->input('extension')
        );

        return $this->respondWithSuccess(
            $this->transformItem($deviceIcon, new DeviceIconTransformer),
            trans('validations/api/general/device/icon/store.result.success')
        );
    }

    /**
     * @param int $deviceId
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function destroy(
        int $deviceId
    ) : JsonResponse
    {
        /**
         * Getting device icons
         */
        $deviceIcons = $this->deviceIconRepository->getForDevice(
            $deviceId
        );

        /**
         * Deleting device icons
         */
        $this->deviceIconService->deleteIcons(
            $deviceIcons
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/device/icon/destroy.result.success')
        );
    }
}
