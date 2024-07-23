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
     * Guest namespace
     */
    Route::group([
        'namespace'  => 'Guest',
        'middleware' => [
            'auth.apikey',
            'localization'
        ]
    ], function () {

        /**
         * Activity namespace
         */
        Route::group(['namespace' => 'Activity'], function () {

            Route::get('activity/{activityId}', 'ActivityController@getForActivity')
                ->name('api.activity');

            Route::post('activities', 'ActivityController@getForActivities')
                ->name('api.activities');
        });

        /**
         * Admin namespace
         */
        Route::group(['namespace' => 'Admin'], function () {

            /**
             * Getting admins avatars
             */
            Route::post('admins/avatars', 'AdminController@getForAdmins')
                ->name('api.admins.avatars');
        });

        /**
         * Alert namespace
         */
        Route::group(['namespace' => 'Alert'], function () {

            /**
             * Getting alert media
             */
            Route::get('alert/{alertId}', 'AlertController@getForAlert')
                ->name('api.alert');

            /**
             * Getting alerts media
             */
            Route::post('alerts', 'AlertController@getForAlerts')
                ->name('api.alerts');
        });

        /**
         * Category namespace
         */
        Route::group(['namespace' => 'Category'], function () {

            /**
             * Getting category icon
             */
            Route::get('category/{id}/icons', 'CategoryIconController@getForCategory')
                ->name('api.category.icons');

            /**
             * Getting categories icons
             */
            Route::post('categories/icons', 'CategoryIconController@getForCategories')
                ->name('api.categories.icons');
        });

        /**
         * Device namespace
         */
        Route::group(['namespace' => 'Device'], function () {

            /**
             * Getting device icon
             */
            Route::get('device/{id}/icons', 'DeviceIconController@getForDevice')
                ->name('api.device.icons');

            /**
             * Getting devices icons
             */
            Route::post('devices/icons', 'DeviceIconController@getForDevices')
                ->name('api.devices.icons');
        });

        /**
         * Payment namespace
         */
        Route::group(['namespace' => 'Payment'], function () {

            /**
             * Getting payment method images
             */
            Route::get('payment/method/{id}/images', 'PaymentMethodImageController@getForPaymentMethod')
                ->name('api.payment.method.images');

            /**
             * Getting payment methods images
             */
            Route::post('payment/methods/images', 'PaymentMethodImageController@getForPaymentMethods')
                ->name('api.payment.methods.images');
        });

        /**
         * Platform namespace
         */
        Route::group(['namespace' => 'Platform'], function () {

            /**
             * Getting platform icon
             */
            Route::get('platform/{id}/icons', 'PlatformIconController@getForPlatform')
                ->name('api.platform.icons');

            /**
             * Getting platforms icons
             */
            Route::post('platforms/icons', 'PlatformIconController@getForPlatforms')
                ->name('api.platforms.icons');
        });

        /**
         * Search namespace
         */
        Route::group(['namespace' => 'Search'], function () {

            /**
             * Getting client global search media
             */
            Route::post('search/client/global', 'SearchController@getForClientGlobal')
                ->name('api.search.client.global');
        });

        /**
         * User namespace
         */
        Route::group(['namespace' => 'User'], function () {

            /**
             * Getting all user media
             */
            Route::post('user/{authId}', 'UserController@getForUser')
                ->name('api.user');

            /**
             * Getting all users media
             */
            Route::post('users', 'UserController@getForUsers')
                ->name('api.users');

            /**
             * Getting all user request media
             */
            Route::get('user/request/{requestId}', 'UserController@getForRequest')
                ->name('api.user.request');

            /**
             * Getting users avatar
             */
            Route::post('users/avatars', 'UserAvatarController@getForUsers')
                ->name('api.users.avatars');

            /**
             * Checking user image existence
             */
            Route::get('user/{authId}/image/{id}/exists', 'UserImageController@existsForUser')
                ->name('api.user.image.exists');

            /**
             * Checking user video existence
             */
            Route::get('user/{authId}/video/{id}/exists', 'UserVideoController@existsForUser')
                ->name('api.user.video.exists');

            /**
             * Getting user id verifications images
             */
            Route::get('user/{authId}/id/verification/images', 'UserIdVerificationImageController@getForUser')
                ->name('api.user.id.verification.images');

            /**
             * Getting user id verifications images for request
             */
            Route::get('user/id/verification/images/request/{requestId}', 'UserIdVerificationImageController@getForRequest')
                ->name('api.user.id.verification.images.request');
        });

        /**
         * Vybe namespace
         */
        Route::group(['namespace' => 'Vybe'], function () {

            /**
             * Getting vybe images
             */
            Route::post('vybe/images/show/many', 'VybeImageController@showMany')
                ->name('api.vybe.images.show.many');

            /**
             * Getting vybe videos
             */
            Route::post('vybe/videos/show/many', 'VybeVideoController@showMany')
                ->name('api.vybe.videos.show.many');
        });
    });
});
