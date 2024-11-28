<?php

return [


'paths' => ['api/*', 'sanctum/csrf-cookie'],

'supports_credentials' => true,
'allowed_origins' => ['*'],  // Allow all origins, you can change this to specific domains
'allowed_origins_patterns' => [],
'allowed_headers' => ['Content-Type', 'X-Requested-With', 'Authorization'],
'allowed_methods' => ['*'],  // Allow all HTTP methods (GET, POST, PUT, DELETE, etc.)
'exposed_headers' => [],
'max_age' => 0,
'hosts' => [],
];

