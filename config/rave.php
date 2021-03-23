<?php

/*
 * This file is part of the Laravel Rave package.
 *
 * (c) Oluwole Adebiyi - Flamez <flamekeed@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /**
     * Public Key: Your Rave publicKey. Sign up on https://rave.flutterwave.com/ to get one from your settings page
     *
     */
    'publicKey' => 'FLWPUBK-630f2049e9a1515dc916602cc55ad485-X',

    /**
     * Secret Key: Your Rave secretKey. Sign up on https://rave.flutterwave.com/ to get one from your settings page
     *
     */
    'secretKey' => 'FLWSECK-2fa483b17fbd2991fef4eec39243bc37-X',

    /**
     * Company/Business/Store Name: The name of your store
     *
     */
    'title' => 'TripOn',

    /**
     * Environment: This can either be 'staging' or 'live'
     *
     */
    'env' => env('RAVE_ENVIRONMENT', 'staging'),

    /**
     * Logo: Enter the URL of your company/business logo
     *
     */
    'logo' => env('RAVE_LOGO', ''),

    /**
     * Prefix: This is added to the front of your transaction reference numbers
     *
     */
    'prefix' => env('RAVE_PREFIX', 'CP'),

    /**
     * Prefix: This is added to the front of your transaction reference numbers
     *
     */
    'secretHash' => 'triponbus',
];
