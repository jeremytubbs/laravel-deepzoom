<?php

return [
    // source path for images to me tiled
    'source_path' => public_path('images'),
    // destination path for tiled output
    'destination_path' => public_path('images'),
    // Choose between gd and imagick support.
    'driver' => 'imagick',
];