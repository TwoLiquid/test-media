<?php

namespace App\Services\Withdrawal;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\WithdrawalReceiptProof\WithdrawalReceiptProofDocument;
use App\Repositories\Withdrawal\WithdrawalReceiptProofDocumentRepository;
use App\Services\File\FileService;
use App\Services\Withdrawal\Interfaces\WithdrawalReceiptProofDocumentServiceInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class WithdrawalReceiptProofDocumentService
 *
 * @package App\Services\WithdrawalReceiptProof
 */
final class WithdrawalReceiptProofDocumentService extends FileService implements WithdrawalReceiptProofDocumentServiceInterface
{
    /**
     * Storage disk environment
     */
    protected const ENVIRONMENT = 'public';

    /**
     * Document files storage name
     */
    protected const FOLDER = 'withdrawal_receipt_proof_documents';

    /**
     * @var WithdrawalReceiptProofDocumentRepository
     */
    protected WithdrawalReceiptProofDocumentRepository $withdrawalReceiptProofDocumentRepository;

    /**
     * WithdrawalReceiptProofDocumentService constructor
     */
    public function __construct()
    {
        /** @var WithdrawalReceiptProofDocumentRepository withdrawalReceiptProofDocumentRepository */
        $this->withdrawalReceiptProofDocumentRepository = new WithdrawalReceiptProofDocumentRepository();
    }

    /**
     * @param string $receiptId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return WithdrawalReceiptProofDocument
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createDocument(
        string $receiptId,
        string $content,
        string $mime,
        string $extension
    ) : WithdrawalReceiptProofDocument
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
         * Creating a withdrawal receipt proof document
         */
        return $this->withdrawalReceiptProofDocumentRepository->store(
            $receiptId,
            $filePath,
            $mime
        );
    }

    /**
     * @param string $receiptId
     * @param array $withdrawalReceiptProofDocumentFiles
     *
     * @return Collection
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createDocuments(
        string $receiptId,
        array $withdrawalReceiptProofDocumentFiles
    ) : Collection
    {
        /**
         * Preparing a withdrawal receipt proof documents collection
         */
        $withdrawalReceiptProofDocuments = new Collection();

        /** @var array $withdrawalReceiptProofDocumentFile */
        foreach ($withdrawalReceiptProofDocumentFiles as $withdrawalReceiptProofDocumentFile) {

            /**
             * Pushing created withdrawal receipt proof documents to response
             */
            $withdrawalReceiptProofDocuments->push(
                $this->createDocument(
                    $receiptId,
                    $withdrawalReceiptProofDocumentFile['content'],
                    $withdrawalReceiptProofDocumentFile['mime'],
                    $withdrawalReceiptProofDocumentFile['extension']
                )
            );
        }

        return $withdrawalReceiptProofDocuments;
    }

    /**
     * @param WithdrawalReceiptProofDocument $withdrawalReceiptProofDocument
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteDocument(
        WithdrawalReceiptProofDocument $withdrawalReceiptProofDocument
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $withdrawalReceiptProofDocument->url
        );

        /**
         * Deleting withdrawal receipt proof document
         */
        return $this->withdrawalReceiptProofDocumentRepository->delete(
            $withdrawalReceiptProofDocument
        );
    }

    /**
     * @param Collection $withdrawalReceiptProofDocuments
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteDocuments(
        Collection $withdrawalReceiptProofDocuments
    ) : bool
    {
        /** @var WithdrawalReceiptProofDocument $withdrawalReceiptProofDocument */
        foreach ($withdrawalReceiptProofDocuments as $withdrawalReceiptProofDocument) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $withdrawalReceiptProofDocument->url
            );
        }

        /**
         * Deleting withdrawal receipt proof documents
         */
        return $this->withdrawalReceiptProofDocumentRepository->deleteByIds(
            $withdrawalReceiptProofDocuments->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
