<?php

namespace App\Services\VatNumber;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\VatNumberProof\VatNumberProofDocument;
use App\Repositories\VatNumber\VatNumberProofDocumentRepository;
use App\Services\File\FileService;
use App\Services\VatNumber\Interfaces\VatNumberProofDocumentServiceInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class VatNumberProofDocumentService
 *
 * @package App\Services\VatNumber
 */
final class VatNumberProofDocumentService extends FileService implements VatNumberProofDocumentServiceInterface
{
    /**
     * Storage disk environment
     */
    protected const ENVIRONMENT = 'public';

    /**
     * Document files storage name
     */
    protected const FOLDER = 'vat_number_proof_documents';

    /**
     * @var VatNumberProofDocumentRepository
     */
    protected VatNumberProofDocumentRepository $vatNumberProofDocumentRepository;

    /**
     * VatNumberProofDocumentService constructor
     */
    public function __construct()
    {
        /** @var VatNumberProofDocumentRepository vatNumberProofDocumentRepository */
        $this->vatNumberProofDocumentRepository = new VatNumberProofDocumentRepository();
    }

    /**
     * @param string $vatNumberProofId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return VatNumberProofDocument
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createDocument(
        string $vatNumberProofId,
        string $content,
        string $mime,
        string $extension
    ) : VatNumberProofDocument
    {
        /**
         * Uploading file
         */
        $filePath = $this->uploadFile(
            $content,
            $extension,
            self::FOLDER
        );

        /**
         * Creating vat number proof document
         */
        return $this->vatNumberProofDocumentRepository->store(
            $vatNumberProofId,
            $filePath,
            $mime
        );
    }

    /**
     * @param string $vatNumberProofId
     * @param array $vatNumberProofDocumentFiles
     *
     * @return Collection
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createDocuments(
        string $vatNumberProofId,
        array $vatNumberProofDocumentFiles
    ) : Collection
    {
        /**
         * Preparing a vat number proof documents collection
         */
        $vatNumberProofDocuments = new Collection();

        /** @var array $vatNumberProofDocumentFile */
        foreach ($vatNumberProofDocumentFiles as $vatNumberProofDocumentFile) {

            /**
             * Pushing created vat number proof documents to response
             */
            $vatNumberProofDocuments->push(
                $this->createDocument(
                    $vatNumberProofId,
                    $vatNumberProofDocumentFile['content'],
                    $vatNumberProofDocumentFile['mime'],
                    $vatNumberProofDocumentFile['extension']
                )
            );
        }

        return $vatNumberProofDocuments;
    }

    /**
     * @param VatNumberProofDocument $vatNumberProofDocument
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteDocument(
        VatNumberProofDocument $vatNumberProofDocument
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $vatNumberProofDocument->url
        );

        /**
         * Deleting vat number proof document
         */
        return $this->vatNumberProofDocumentRepository->delete(
            $vatNumberProofDocument
        );
    }

    /**
     * @param Collection $vatNumberProofDocuments
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteDocuments(
        Collection $vatNumberProofDocuments
    ) : bool
    {
        /** @var VatNumberProofDocument $vatNumberProofDocument */
        foreach ($vatNumberProofDocuments as $vatNumberProofDocument) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $vatNumberProofDocument->url
            );
        }

        /**
         * Deleting vat number proof documents
         */
        return $this->vatNumberProofDocumentRepository->deleteByIds(
            $vatNumberProofDocuments->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
