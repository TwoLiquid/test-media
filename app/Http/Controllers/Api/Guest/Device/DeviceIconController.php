<?php

namespace App\Http\Controllers\Api\Guest\Device;

use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\Guest\Device\Interfaces\DeviceIconControllerInterface;
use App\Http\Requests\Api\Guest\Device\Icon\GetForDevicesRequest;
use App\Repositories\Device\DeviceIconRepository;
use App\Services\Device\DeviceIconService;
use App\Transformers\Api\Guest\Device\DeviceIconTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class DeviceController
 *
 * @package App\Http\Controllers\Api\Guest\Device
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
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function getForDevice(
        int $deviceId
    ) : JsonResponse
    {
        /**
         * Getting device icons
         */
        $deviceIcons = $this->deviceIconRepository->getForDevice(
            $deviceId
        );

        return $this->respondWithSuccess(
            $this->transformCollection($deviceIcons, new DeviceIconTransformer),
            trans('validations/api/guest/device/icon/getForDevice.result.success')
        );
    }

    /**
     * @param GetForDevicesRequest $request
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function getForDevices(
        GetForDevicesRequest $request
    ) : JsonResponse
    {
        /**
         * Getting device icons
         */
        $deviceIcons = $this->deviceIconRepository->getForDevices(
            $request->input('devices_ids')
        );

        return $this->respondWithSuccess(
            $this->transformCollection($deviceIcons, new DeviceIconTransformer),
            trans('validations/api/guest/device/icon/getForDevices.result.success')
        );
    }
}
