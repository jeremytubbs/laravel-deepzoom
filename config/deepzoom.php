<?php

return [
    'source_path' => storage_path('app/images'),
    'destination_path' => storage_path('tiles'),

    // Choose between gd and imagick support.
    'driver' => 'gd',
    'tile_format' => 'jpg',
];
