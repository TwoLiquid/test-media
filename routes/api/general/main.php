<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api'], function () {

    /**
     * General API routes
     */
    Route::group([
        'namespace'  => 'General',
        'middleware' => [
            'gateway',
            'localization'
        ]
    ], function () {

        /**
         * Activity namespace
         */
        Route::group(['namespace' => 'Activity'], function () {

            /**
             * Creating activity images
             */
            Route::post('activity/{activityId}/images', 'ActivityImageController@storeMany')
                ->name('api.activity.images.store');

            /**
             * Deleting activity images
             */
            Route::delete('activity/{activityId}/images', 'ActivityImageController@destroy')
                ->name('api.activity.images.destroy');
        });

        /**
         * Admin namespace
         */
        Route::group(['namespace' => 'Admin'], function () {

            /**
             * Creating admin avatar
             */
            Route::post('admin/{authId}/avatar', 'AdminAvatarController@store')
                ->name('api.admin.avatar.store');

            /**
             * Deleting admin avatars
             */
            Route::delete('admin/{authId}/avatars', 'AdminAvatarController@destroy')
                ->name('api.admin.avatars.destroy');
        });

        /**
         * Alert namespace
         */
        Route::group(['namespace' => 'Alert'], function () {

            /**
             * Creating alert images
             */
            Route::post('alert/{id}/images', 'AlertImageController@storeMany')
                ->name('api.alert.images.store');

            /**
             * Deleting alert images
             */
            Route::delete('alert/images', 'AlertImageController@destroyMany')
                ->name('api.alert.images.destroy');

            /**
             * Creating alert sounds
             */
            Route::post('alert/{id}/sounds', 'AlertSoundController@storeMany')
                ->name('api.alert.sounds.store');

            /**
             * Deleting alert sounds
             */
            Route::delete('alert/sounds', 'AlertSoundController@destroyMany')
                ->name('api.alert.sounds.destroy');
        });

        /**
         * Category namespace
         */
        Route::group(['namespace' => 'Category'], function () {

            /**
             * Creating category icon
             */
            Route::post('category/{id}/icon', 'CategoryIconController@store')
                ->name('api.category.icon.store');

            /**
             * Deleting category icons
             */
            Route::delete('category/{id}/icons', 'CategoryIconController@destroy')
                ->name('api.category.icons.destroy');
        });

        /**
         * Chat namespace
         */
        Route::group(['namespace' => 'Chat'], function () {

            /**
             * Getting chat messages media
             */
            Route::post('chat/messages', 'ChatMessageController@getForChatMessages')
                ->name('api.chat.messages');

            /**
             * Deleting chat messages media
             */
            Route::delete('chat/message/{chatMessageId}', 'ChatMessageController@deleteForChatMessage')
                ->name('api.chat.message.delete');

            /**
             * Downloading chat message audio
             */
            Route::get('chat/message/audio/{id}/download', 'ChatMessageAudioController@downloadFile')
                ->name('api.chat.message.audio.download');

            /**
             * Creating chat message audio
             */
            Route::post('chat/message/{chatMessageId}/audio', 'ChatMessageAudioController@store')
                ->name('api.chat.message.audio.store');

            /**
             * Creating chat message audios
             */
            Route::post('chat/message/{chatMessageId}/audios', 'ChatMessageAudioController@storeMany')
                ->name('api.chat.message.audios.store');

            /**
             * Deleting chat message audios
             */
            Route::delete('chat/message/{chatMessageId}/audios', 'ChatMessageAudioController@destroyMany')
                ->name('api.chat.message.audios.destroy');

            /**
             * Downloading chat message document
             */
            Route::get('chat/message/document/{id}/download', 'ChatMessageDocumentController@downloadFile')
                ->name('api.chat.message.document.download');

            /**
             * Creating chat message document
             */
            Route::post('chat/message/{chatMessageId}/document', 'ChatMessageDocumentController@store')
                ->name('api.chat.message.document.store');

            /**
             * Creating chat message documents
             */
            Route::post('chat/message/{chatMessageId}/documents', 'ChatMessageDocumentController@storeMany')
                ->name('api.chat.message.documents.store');

            /**
             * Deleting chat message documents
             */
            Route::delete('chat/message/{chatMessageId}/documents', 'ChatMessageDocumentController@destroyMany')
                ->name('api.chat.message.documents.destroy');

            /**
             * Downloading chat message document
             */
            Route::get('chat/message/image/{id}/download', 'ChatMessageImageController@downloadFile')
                ->name('api.chat.message.image.download');

            /**
             * Downloading minimized chat message document
             */
            Route::get('chat/message/image/{id}/download/min', 'ChatMessageImageController@downloadMinFile')
                ->name('api.chat.message.image.download.min');

            /**
             * Creating chat message document
             */
            Route::post('chat/message/{chatMessageId}/image', 'ChatMessageImageController@store')
                ->name('api.chat.message.image.store');

            /**
             * Creating chat message documents
             */
            Route::post('chat/message/{chatMessageId}/images', 'ChatMessageImageController@storeMany')
                ->name('api.chat.message.images.store');

            /**
             * Deleting chat message documents
             */
            Route::delete('chat/message/{chatMessageId}/images', 'ChatMessageImageController@destroyMany')
                ->name('api.chat.message.images.destroy');

            /**
             * Downloading chat message video
             */
            Route::get('chat/message/video/{id}/download', 'ChatMessageVideoController@downloadFile')
                ->name('api.chat.message.video.download');

            /**
             * Creating chat message video
             */
            Route::post('chat/message/{chatMessageId}/video', 'ChatMessageVideoController@store')
                ->name('api.chat.message.video.store');

            /**
             * Creating chat message videos
             */
            Route::post('chat/message/{chatMessageId}/videos', 'ChatMessageVideoController@storeMany')
                ->name('api.chat.message.videos.store');

            /**
             * Deleting chat message videos
             */
            Route::delete('chat/message/{chatMessageId}/videos', 'ChatMessageVideoController@destroyMany')
                ->name('api.chat.message.videos.destroy');

            /**
             * Downloading chat message video thumbnail
             */
            Route::get('chat/message/video/thumbnail/{id}/download', 'ChatMessageVideoThumbnailController@downloadFile')
                ->name('api.chat.message.video.thumbnail.download');

            /**
             * Downloading minimized chat message video thumbnail
             */
            Route::get('chat/message/video/thumbnail/{id}/download/min', 'ChatMessageVideoThumbnailController@downloadMinFile')
                ->name('api.chat.message.video.thumbnail.download.min');
        });

        /**
         * Device namespace
         */
        Route::group(['namespace' => 'Device'], function () {

            /**
             * Creating device icon
             */
            Route::post('device/{id}/icon', 'DeviceIconController@store')
                ->name('api.device.icon.store');

            /**
             * Deleting device icons
             */
            Route::delete('device/{id}/icons', 'DeviceIconController@destroy')
                ->name('api.device.icons.destroy');
        });

        /**
         * Payment namespace
         */
        Route::group(['namespace' => 'Payment'], function () {

            /**
             * Creating payment method image
             */
            Route::post('payment/method/{id}/image', 'PaymentMethodImageController@store')
                ->name('api.payment.method.image.store');

            /**
             * Deleting payment method images
             */
            Route::delete('payment/method/{id}/images', 'PaymentMethodImageController@destroy')
                ->name('api.payment.method.images.destroy');
        });

        /**
         * Platform namespace
         */
        Route::group(['namespace' => 'Platform'], function () {

            /**
             * Creating platform icon
             */
            Route::post('platform/{id}/icon', 'PlatformIconController@store')
                ->name('api.platform.icon.store');

            /**
             * Deleting platform icons
             */
            Route::delete('platform/{id}/icons', 'PlatformIconController@destroy')
                ->name('api.platform.icons.destroy');
        });

        /**
         * Review namespace
         */
        Route::group(['namespace' => 'Review'], function () {

            /**
             * Getting review messages media
             */
            Route::post('review/messages', 'ReviewMessageController@getForReviewMessages')
                ->name('api.review.messages');

            /**
             * Deleting review messages media
             */
            Route::delete('review/message/{messageId}', 'ReviewMessageController@deleteForReviewMessage')
                ->name('api.review.message.delete');

            /**
             * Downloading review message document
             */
            Route::get('review/message/image/{id}/download', 'ReviewMessageImageController@downloadFile')
                ->name('api.review.message.image.download');

            /**
             * Downloading a minimized review message document
             */
            Route::get('review/message/image/{id}/download/min', 'ReviewMessageImageController@downloadMinFile')
                ->name('api.review.message.image.download.min');

            /**
             * Creating a review message document
             */
            Route::post('review/message/{messageId}/image', 'ReviewMessageImageController@store')
                ->name('api.review.message.image.store');

            /**
             * Creating review message documents
             */
            Route::post('review/message/{messageId}/images', 'ReviewMessageImageController@storeMany')
                ->name('api.review.message.images.store');

            /**
             * Deleting review message documents
             */
            Route::delete('review/message/{messageId}/images', 'ReviewMessageImageController@destroyMany')
                ->name('api.review.message.images.destroy');

            /**
             * Downloading review message video
             */
            Route::get('review/message/video/{id}/download', 'ReviewMessageVideoController@downloadFile')
                ->name('api.review.message.video.download');

            /**
             * Creating review message video
             */
            Route::post('review/message/{messageId}/video', 'ReviewMessageVideoController@store')
                ->name('api.review.message.video.store');

            /**
             * Creating review message videos
             */
            Route::post('review/message/{messageId}/videos', 'ReviewMessageVideoController@storeMany')
                ->name('api.review.message.videos.store');

            /**
             * Deleting review message videos
             */
            Route::delete('review/message/{messageId}/videos', 'ReviewMessageVideoController@destroyMany')
                ->name('api.review.message.videos.destroy');

            /**
             * Downloading review message video thumbnail
             */
            Route::get('review/message/video/thumbnail/{id}/download', 'ReviewMessageVideoThumbnailController@downloadFile')
                ->name('api.review.message.video.thumbnail.download');

            /**
             * Downloading minimized review message video thumbnail
             */
            Route::get('review/message/video/thumbnail/{id}/download/min', 'ReviewMessageVideoThumbnailController@downloadMinFile')
                ->name('api.review.message.video.thumbnail.download.min');
        });

        /**
         * Support namespace
         */
        Route::group(['namespace' => 'Support'], function () {

            /**
             * Ticket namespace
             */
            Route::group(['namespace' => 'Ticket'], function () {

                /**
                 * Getting support ticket messages media
                 */
                Route::post('support/ticket/messages', 'SupportTicketMessageController@getForSupportTicketMessages')
                    ->name('api.support.ticket.messages');

                /**
                 * Deleting support ticket messages media
                 */
                Route::delete('support/ticket/message/{messageId}', 'SupportTicketMessageController@deleteForSupportTicketMessage')
                    ->name('api.support.ticket.message.delete');

                /**
                 * Downloading support ticket message audio
                 */
                Route::get('support/ticket/message/audio/{id}/download', 'SupportTicketMessageAudioController@downloadFile')
                    ->name('api.support.ticket.message.audio.download');

                /**
                 * Creating support ticket message audio
                 */
                Route::post('support/ticket/message/{messageId}/audio', 'SupportTicketMessageAudioController@store')
                    ->name('api.support.ticket.message.audio.store');

                /**
                 * Creating support ticket message audios
                 */
                Route::post('support/ticket/message/{messageId}/audios', 'SupportTicketMessageAudioController@storeMany')
                    ->name('api.support.ticket.message.audios.store');

                /**
                 * Deleting support ticket message audios
                 */
                Route::delete('support/ticket/message/{messageId}/audios', 'SupportTicketMessageAudioController@destroyMany')
                    ->name('api.support.ticket.message.audios.destroy');

                /**
                 * Downloading a support ticket message document
                 */
                Route::get('support/ticket/message/document/{id}/download', 'SupportTicketMessageDocumentController@downloadFile')
                    ->name('api.support.ticket.message.document.download');

                /**
                 * Creating a support ticket message document
                 */
                Route::post('support/ticket/message/{messageId}/document', 'SupportTicketMessageDocumentController@store')
                    ->name('api.support.ticket.message.document.store');

                /**
                 * Creating support ticket message documents
                 */
                Route::post('support/ticket/message/{messageId}/documents', 'SupportTicketMessageDocumentController@storeMany')
                    ->name('api.support.ticket.message.documents.store');

                /**
                 * Deleting support ticket message documents
                 */
                Route::delete('support/ticket/message/{messageId}/documents', 'SupportTicketMessageDocumentController@destroyMany')
                    ->name('api.support.ticket.message.documents.destroy');

                /**
                 * Downloading a support ticket message document
                 */
                Route::get('support/ticket/message/image/{id}/download', 'SupportTicketMessageImageController@downloadFile')
                    ->name('api.support.ticket.message.image.download');

                /**
                 * Downloading a minimized support ticket message document
                 */
                Route::get('support/ticket/message/image/{id}/download/min', 'SupportTicketMessageImageController@downloadMinFile')
                    ->name('api.support.ticket.message.image.download.min');

                /**
                 * Creating a support ticket message document
                 */
                Route::post('support/ticket/message/{messageId}/image', 'SupportTicketMessageImageController@store')
                    ->name('api.support.ticket.message.image.store');

                /**
                 * Creating support ticket message documents
                 */
                Route::post('support/ticket/message/{messageId}/images', 'SupportTicketMessageImageController@storeMany')
                    ->name('api.support.ticket.message.images.store');

                /**
                 * Deleting support ticket message documents
                 */
                Route::delete('support/ticket/message/{messageId}/images', 'SupportTicketMessageImageController@destroyMany')
                    ->name('api.support.ticket.message.images.destroy');

                /**
                 * Downloading support ticket message video
                 */
                Route::get('support/ticket/message/video/{id}/download', 'SupportTicketMessageVideoController@downloadFile')
                    ->name('api.support.ticket.message.video.download');

                /**
                 * Creating support ticket message video
                 */
                Route::post('support/ticket/message/{messageId}/video', 'SupportTicketMessageVideoController@store')
                    ->name('api.support.ticket.message.video.store');

                /**
                 * Creating support ticket message videos
                 */
                Route::post('support/ticket/message/{messageId}/videos', 'SupportTicketMessageVideoController@storeMany')
                    ->name('api.support.ticket.message.videos.store');

                /**
                 * Deleting support ticket message videos
                 */
                Route::delete('support/ticket/message/{messageId}/videos', 'SupportTicketMessageVideoController@destroyMany')
                    ->name('api.support.ticket.message.videos.destroy');

                /**
                 * Downloading support ticket message video thumbnail
                 */
                Route::get('support/ticket/message/video/thumbnail/{id}/download', 'SupportTicketMessageVideoThumbnailController@downloadFile')
                    ->name('api.support.ticket.message.video.thumbnail.download');

                /**
                 * Downloading minimized support ticket message video thumbnail
                 */
                Route::get('support/ticket/message/video/thumbnail/{id}/download/min', 'SupportTicketMessageVideoThumbnailController@downloadMinFile')
                    ->name('api.support.ticket.message.video.thumbnail.download.min');
            });
        });

        /**
         * User namespace
         */
        Route::group(['namespace' => 'User'], function () {

            /**
             * Creating user avatar
             */
            Route::post('user/{authId}/avatar', 'UserAvatarController@store')
                ->name('api.user.avatar.store');

            /**
             * Accepting user request avatar
             */
            Route::patch('user/avatar/request/{requestId}/accept', 'UserAvatarController@acceptForRequest')
                ->name('api.user.avatar.request.accept');

            /**
             * Declining user request avatar
             */
            Route::patch('user/avatar/request/{requestId}/decline', 'UserAvatarController@declineForRequest')
                ->name('api.user.avatar.request.decline');

            /**
             * Creating user background
             */
            Route::post('user/{authId}/background', 'UserBackgroundController@store')
                ->name('api.user.background.store');

            /**
             * Accepting user request background
             */
            Route::patch('user/background/request/{requestId}/accept', 'UserBackgroundController@acceptForRequest')
                ->name('api.user.background.request.accept');

            /**
             * Declining user request background
             */
            Route::patch('user/background/request/{requestId}/decline', 'UserBackgroundController@declineForRequest')
                ->name('api.user.background.request.decline');

            /**
             * Creating user voice sample
             */
            Route::post('user/{authId}/voice/sample', 'UserVoiceSampleController@store')
                ->name('api.user.voice.sample.store');

            /**
             * Accepting user request voice sample
             */
            Route::patch('user/voice/sample/request/{requestId}/accept', 'UserVoiceSampleController@acceptForRequest')
                ->name('api.user.voice.sample.request.accept');

            /**
             * Declining user request voice sample
             */
            Route::patch('user/voice/sample/request/{requestId}/decline', 'UserVoiceSampleController@declineForRequest')
                ->name('api.user.voice.sample.request.decline');

            /**
             * Downloading user voice sample
             */
            Route::get('user/voice/sample/{id}/download', 'UserVoiceSampleController@downloadFile')
                ->name('api.user.voice.sample.download');

            /**
             * Creating user images
             */
            Route::post('user/{authId}/images', 'UserImageController@storeMany')
                ->name('api.user.images.store');

            /**
             * Accepting user request images
             */
            Route::patch('user/images/request/{requestId}/accept', 'UserImageController@acceptForRequest')
                ->name('api.user.images.request.accept');

            /**
             * Declining user request images
             */
            Route::patch('user/images/request/{requestId}/decline', 'UserImageController@declineForRequest')
                ->name('api.user.images.request.decline');

            /**
             * Updating user image
             */
            Route::patch('user/image/{id}/likes', 'UserImageController@updateLikes')
                ->name('api.user.image.likes.update');

            /**
             * Creating user videos
             */
            Route::post('user/{authId}/videos', 'UserVideoController@storeMany')
                ->name('api.user.videos.store');

            /**
             * Accepting user request videos
             */
            Route::patch('user/videos/request/{requestId}/accept', 'UserVideoController@acceptForRequest')
                ->name('api.user.videos.request.accept');

            /**
             * Declining user request videos
             */
            Route::patch('user/videos/request/{requestId}/decline', 'UserVideoController@declineForRequest')
                ->name('api.user.videos.request.decline');

            /**
             * Updating user video
             */
            Route::patch('user/video/{id}/likes', 'UserVideoController@updateLikes')
                ->name('api.user.video.likes.update');

            /**
             * Creating user id verification image
             */
            Route::post('user/{authId}/id/verification/image', 'UserIdVerificationImageController@store')
                ->name('api.user.id.verification.image');

            /**
             * Declining user id verification request images
             */
            Route::patch('user/id/verification/images/request/{requestId}/decline', 'UserIdVerificationImageController@declineForRequest')
                ->name('api.user.id.verification.images.request.decline');

            /**
             * Getting user sticker categories
             */
            Route::get('user/sticker/categories', 'UserStickerController@getCategories')
                ->name('api.user.sticker.categories');

            /**
             * Getting featured user stickers
             */
            Route::get('user/sticker/featured', 'UserStickerController@getFeatured')
                ->name('api.user.sticker.featured');

            /**
             * Searching user stickers by query
             */
            Route::get('user/sticker/search', 'UserStickerController@searchByQuery')
                ->name('api.user.sticker.search');

            /**
             * Searching user stickers by query
             */
            Route::get('user/sticker/favorites', 'UserStickerController@getFavorites')
                ->name('api.user.sticker.favorites');

            /**
             * Searching user sticker by id
             */
            Route::get('user/sticker/id', 'UserStickerController@getById')
                ->name('api.user.sticker.id');

            /**
             * Searching user stickers by ids
             */
            Route::get('user/sticker/ids', 'UserStickerController@getByIds')
                ->name('api.user.sticker.ids');

            /**
             * Creating user favorite ticket
             */
            Route::post('user/sticker/favorite', 'UserStickerController@storeFavorite')
                ->name('api.user.sticker.favorite.store');

            /**
             * Deleting user favorite ticket
             */
            Route::delete('user/sticker/favorite', 'UserStickerController@deleteFavorite')
                ->name('api.user.sticker.favorite.delete');
        });

        /**
         * Vat number namespace
         */
        Route::group(['namespace' => 'VatNumber'], function () {

            /**
             * Getting vat number proofs getting all data by billing
             */
            Route::get('vat/number/proof/{id}', 'VatNumberProofController@getForVatNumberProof')
                ->name('api.vat.number.proof');

            /**
             * Vat number proof getting all data
             */
            Route::post('vat/number/proofs', 'VatNumberProofController@getForVatNumberProofs')
                ->name('api.vat.number.proofs');

            /**
             * Creating vat number proof documents
             */
            Route::post('vat/number/proof/{id}/documents', 'VatNumberProofDocumentController@storeMany')
                ->name('api.vat.number.proof.documents.store');

            /**
             * Creating vat number proof images
             */
            Route::post('vat/number/proof/{id}/images', 'VatNumberProofImageController@storeMany')
                ->name('api.vat.number.proof.images.store');
        });

        /**
         * Vybe namespace
         */
        Route::group(['namespace' => 'Vybe'], function () {

            /**
             * Creating vybe images
             */
            Route::post('vybe/images', 'VybeImageController@storeMany')
                ->name('api.vybe.images.store');

            /**
             * Accepting request vybe images
             */
            Route::patch('vybe/images/accept', 'VybeImageController@acceptMany')
                ->name('api.vybe.images.accept');

            /**
             * Declining request vybe images
             */
            Route::patch('vybe/images/decline', 'VybeImageController@declineMany')
                ->name('api.vybe.images.decline');

            /**
             * Deleting vybe images
             */
            Route::delete('vybe/images', 'VybeImageController@destroyMany')
                ->name('api.vybe.images.destroy');

            /**
             * Creating vybe videos
             */
            Route::post('vybe/videos', 'VybeVideoController@storeMany')
                ->name('api.vybe.videos.store');

            /**
             * Accepting request vybe videos
             */
            Route::patch('vybe/videos/accept', 'VybeVideoController@acceptMany')
                ->name('api.vybe.videos.accept');

            /**
             * Declining request vybe videos
             */
            Route::patch('vybe/videos/decline', 'VybeVideoController@declineMany')
                ->name('api.vybe.videos.decline');

            /**
             * Deleting vybe videos
             */
            Route::delete('vybe/videos', 'VybeVideoController@destroyMany')
                ->name('api.vybe.videos.destroy');
        });

        /**
         * Withdrawal receipt proof namespace
         */
        Route::group(['namespace' => 'Withdrawal'], function () {

            /**
             * Getting withdrawal receipt proofs
             */
            Route::get('withdrawal/receipt/{id}/proofs', 'WithdrawalReceiptProofController@getForWithdrawalReceiptProof')
                ->name('api.withdrawal.receipt.proofs');

            /**
             * Getting withdrawal receipts proofs
             */
            Route::post('withdrawal/receipts/proofs', 'WithdrawalReceiptProofController@getForWithdrawalReceiptProofs')
                ->name('api.withdrawal.receipts.proofs');

            /**
             * Creating withdrawal receipt proof documents
             */
            Route::post('withdrawal/receipt/{id}/proof/documents', 'WithdrawalReceiptProofDocumentController@storeMany')
                ->name('api.withdrawal.receipt.proof.documents.store');

            /**
             * Creating withdrawal receipt proof images
             */
            Route::post('withdrawal/receipt/{id}/proof/images', 'WithdrawalReceiptProofImageController@storeMany')
                ->name('api.withdrawal.receipt.proof.images.store');
        });
    });
});
