<?php

return [

    'show_warnings' => false,   // Throw an Exception on warnings from dompdf
    'public_path' => null,  // Override the public path if needed
    'convert_entities' => true,

    'options' => [
        'font_dir' => storage_path('fonts'), // Store fonts in the storage directory
        'font_cache' => storage_path('fonts'),
        'temp_dir' => sys_get_temp_dir(),
        'chroot' => realpath(base_path()),
        'default_media_type' => 'screen',
        'default_paper_size' => 'a4',
        'default_paper_orientation' => 'portrait',
        'dpi' => 96,
        'enable_php' => false,
        'enable_javascript' => true,
        'enable_remote' => false,

        // Add the custom font for Cairo (Arabic font)
        'font_data' => [
            'cairo' => [
                'R'  => 'Cairo-Regular.ttf',    // Regular font
                'B'  => 'Cairo-Bold.ttf',       // Bold font
                'useOTL' => 0xFF,               // Use OpenType Layout
                'useKashida' => 75,             // Adjust Kashida for Arabic support
            ],
        ],

        'default_font' => 'cairo',  // Set Cairo as the default font
    ],

];
