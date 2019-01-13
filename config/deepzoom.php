<?php

return [
    'source_path' => storage_path('images'),
    'destination_path' => public_path('app/images'),

    // Choose between gd and imagick support.
    'driver' => 'gd',
    'tile_format' => 'jpg',
];
