<?php
if (env('APP_ENV') == 'live'){
    $rootDomain = "http://localhost:9000";
    $appDomain = "http://localhost:3000";
} else if (env('APP_ENV') == 'dev'){
    $rootDomain = "http://localhost:9000";
    $appDomain = "http://localhost:3000";
} else {
    $rootDomain = "http://localhost:9000";
    $appDomain = "http://localhost:3000";
}
return [
    'ROOT_DOMAIN' => $rootDomain,
    'APP_DOMAIN' => $appDomain
];
