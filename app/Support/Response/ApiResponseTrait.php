<?php

namespace App\Support\Response;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use stdClass;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Trait ApiResponseTrait
 *
 * @package App\Support\Response
 */
trait ApiResponseTrait
{
    /** @var int  */
    private int $statusCode = 200;

    /** @var array|null  */
    private ?array $pagination = null;

    /**
     * @param int $statusCode
     *
     * @return $this
     */
    protected function setStatusCode(
        int $statusCode
    ) : static
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param LengthAwarePaginator $paginator
     *
     * @return $this
     */
    protected function setPagination(
        LengthAwarePaginator $paginator
    ) : static
    {
        $this->pagination = [
            'page'  => $paginator->currentPage(),
            'by'    => $paginator->perPage(),
            'total' => $paginator->lastPage()
        ];

        return $this;
    }

    /**
     * @return int
     */
    protected function getStatusCode() : int
    {
        return $this->statusCode;
    }

    /**
     * @param array $data
     * @param array $headers
     *
     * @return JsonResponse
     */
    private function respond(
        array $data = [],
        array $headers = []
    ) : JsonResponse
    {
        return response()->json(
            $data,
            $this->getStatusCode(),
            $headers,
            JSON_UNESCAPED_UNICODE
        );
    }

    /**
     * @param array|null $data
     * @param string|null $message
     *
     * @return JsonResponse
     */
    protected function respondWithSuccess(
        array $data = null,
        string $message = null
    ) : JsonResponse {
        $responseBody = $data !== null ? $data : [];
        if ($message !== null) {
            $responseBody['message'] = $message;
        }
        if ($this->pagination !== null) {
            $responseBody['pagination'] = $this->pagination;
            $this->pagination = null;
        }
        if (empty($responseBody)) {
            $responseBody = new stdClass;
        }

        return $this->respond($responseBody);
    }

    /**
     * @param string|null $message
     *
     * @return JsonResponse
     */
    protected function respondWithError(
        string $message = null
    ) : JsonResponse
    {
        return $this->respondRawError($message);
    }

    /**
     * @param array $data
     * @param int $statusCode
     *
     * @return JsonResponse
     */
    protected function respondWithSystemError(
        array $data,
        int $statusCode = 400
    ) : JsonResponse
    {
        $responseBody = [
            'error' => $data
        ];

        return $this->setStatusCode($statusCode)
            ->respond($responseBody);
    }

    /**
     * @param string|null $message
     *
     * @return JsonResponse
     */
    protected function respondNotFound(
        string $message = null
    ): JsonResponse
    {
        return $this->respondRawError($message, Response::HTTP_NOT_FOUND);
    }

    /**
     * @param mixed $data
     * @param int $statusCode
     *
     * @return JsonResponse
     */
    private function respondRawError(
        mixed $data,
        int $statusCode = 400
    ) : JsonResponse
    {
        if (is_string($data)) {
            $responseBody = [
                'errors' => []
            ];

            $responseBody['errors']['message'] = $data;

            if (empty($responseBody['errors'])) {
                $responseBody['errors'] = new stdClass;
            }
        } elseif (is_array($data)) {
            $responseBody = [
                'errors' => $data
            ];
        } else {
            $responseBody = [
                'errors' => [
                    'message' => 'Unknown error.'
                ]
            ];
        }

        return $this->setStatusCode($statusCode)
            ->respond($responseBody);
    }

    /**
     * @param array $messages
     *
     * @return JsonResponse
     */
    protected function respondWithValidationError(
        array $messages
    ) : JsonResponse
    {
        return $this->respondRawError($messages, Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @param string|null $message
     *
     * @return JsonResponse
     */
    protected function respondWithAuthorizationError(
        string $message = null
    ): JsonResponse
    {
        $message = ($message === null ? 'Authorization error.' : $message);

        return $this->respondRawError($message, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @param string $filePath
     * @param string $folder
     *
     * @return BinaryFileResponse
     */
    protected function respondWithDownload(
        string $filePath,
        string $folder = 'private'
    ) : BinaryFileResponse
    {
        return response()->download(
            storage_path('app/' . $folder .'/' . $filePath)
        );
    }
}
