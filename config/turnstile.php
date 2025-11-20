<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cloudflare Turnstile Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for Cloudflare Turnstile CAPTCHA
    | integration. You can get your site key and secret key from the
    | Cloudflare dashboard.
    |
    */

    'site_key' => env('TURNSTILE_SITE_KEY', '0x4AAAAAABzrsCEhgnx_IezQ'),
    'secret_key' => env('TURNSTILE_SECRET_KEY', '0x4AAAAAABzrsHPliAQ7wtKffPXixIkDfyg'),
    
    /*
    |--------------------------------------------------------------------------
    | Turnstile API Endpoint
    |--------------------------------------------------------------------------
    |
    | The Cloudflare Turnstile verification endpoint URL.
    |
    */
    
    'verify_url' => 'https://challenges.cloudflare.com/turnstile/v0/siteverify',
    
    /*
    |--------------------------------------------------------------------------
    | Timeout Settings
    |--------------------------------------------------------------------------
    |
    | Timeout for HTTP requests to Cloudflare API in seconds.
    |
    */
    
    'timeout' => 10,
];
