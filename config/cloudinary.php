<?php

/*
 * This file is part of the Laravel Cloudinary package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Cloudinary Configuration
    |--------------------------------------------------------------------------
    |
    | An HTTP or HTTPS URL to notify your application (a webhook) when the process of uploads, deletes, and any API
    | that accepts notification_url has completed.
    |
    |
    */
    'notification_url' => env('CLOUDINARY_NOTIFICATION_URL'),


    /*
    |--------------------------------------------------------------------------
    | Cloudinary Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your Cloudinary settings. Cloudinary is a cloud hosted
    | media management service for all file uploads, storage, delivery and transformation needs.
    |
    |
    */
    'cloud_url' => env('CLOUDINARY_URL'),

    /**
     * Upload Preset From Cloudinary Dashboard
     *
     */
    'upload_preset' => env('CLOUDINARY_UPLOAD_PRESET'),
    'base_url' => env('CLOUDINARY_BASE_URL', 'https://res.cloudinary.com/dtbzvmb6r/image/upload/'),
    'default_image' => env('CLOUDINARY_DEFAULT_IMAGE', 'https://res.cloudinary.com/dtbzvmb6r/image/upload/products/preview-phone.png')
];
