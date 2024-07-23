<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

/**
 * Class DirectorySeeder
 *
 * @package Database\Seeders
 */
class DirectorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * List of private folders
         */
        $privateFolders = [
            'chat_message_audios',
            'chat_message_documents',
            'chat_message_images',
            'chat_message_video_thumbnails',
            'chat_message_videos',
            'support_ticket_message_audios',
            'support_ticket_message_documents',
            'support_ticket_message_images',
            'support_ticket_message_video_thumbnails',
            'support_ticket_message_videos'
        ];

        /**
         * Cleaning private directory
         */
        File::cleanDirectory(
            storage_path('app/private')
        );

        foreach ($privateFolders as $privateFolder) {
            File::makeDirectory(
                storage_path('app/private/' . $privateFolder),
                0775,
                true
            );
        }

        /**
         * List of public folders
         */
        $publicFolders = [
            'activity_images',
            'admin_avatars',
            'alert_images',
            'alert_sounds',
            'category_icons',
            'device_icons',
            'payment_method_images',
            'platform_icons',
            'user_avatars',
            'user_backgrounds',
            'user_id_verification_images',
            'user_images',
            'user_video_thumbnails',
            'user_videos',
            'user_voice_samples',
            'vat_number_proof_documents',
            'vat_number_proof_images',
            'vybe_images',
            'vybe_video_thumbnails',
            'vybe_videos',
            'withdrawal_receipt_proof_documents',
            'withdrawal_receipt_proof_images',
            'review_message_images',
            'review_message_video_thumbnails',
            'review_message_videos'
        ];

        /**
         * Cleaning public directory
         */
        File::cleanDirectory(
            storage_path('app/public')
        );

        foreach ($publicFolders as $publicFolder) {
            File::makeDirectory(
                storage_path('app/public/' . $publicFolder),
                0775,
                true
            );
        }
    }
}
