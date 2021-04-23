<?php

return [
    /**
     * This switch determines if the honeypot protection should be activated.
     */
    'enabled' => env('IE_HONEYPOT_ENABLED', true),

    /**
     * This switch determines the URL that IE users will get redirect to.
     */
    'redirect_url' => env('IE_HONEYPOT_REDIRECT_URL', '/ie-trap'),

];
