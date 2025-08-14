<?php

return [
    'paths' => [resource_path('views')],
    // Use storage_path directly to avoid realpath(false) when the dir doesn't exist yet
    'compiled' => env('VIEW_COMPILED_PATH', storage_path('framework/views')),
];
