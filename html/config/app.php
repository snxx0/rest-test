<?php

return [
    'debug' => env('APP_DEBUG', false),
    'auth' => env('APP_AUTH', true),

    'nivel_lista' => env('TFM_SEG_GET', 10),
    'nivel_crear' => env('TFM_SEG_POST', 10),
    'nivel_actualizar' => env('TFM_SEG_PUT', 10),
    'nivel_borrar' => env('TFM_SEG_DEL', 10),
    'nivel_global' => env('TFM_SEG_GLOB', 10),
    'nivel_subir' => env('TFM_SEG_UP', 10),
];
