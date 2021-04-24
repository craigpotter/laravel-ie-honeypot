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

    /**
     * This switch determines if the bypass functionality is enabled.
     * This will allow use of the @ieBypass directive and allow IE users to access your
     * site by adding ?ie-bypass=true to a url
     */
    'bypass_enabled' => env('IE_HONEYPOT_BYPASS_ENABLED', true),

];
