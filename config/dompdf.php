<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    |
    | Set some default values. It is possible to add all defines that can be set
    | in dompdf_config.inc.php. You can also override the entire config file.
    |
    */
    'show_warnings'    => false,   // Throw an Exception on warnings from dompdf
    'public_path'      => null,    // Override the public path if needed
    'convert_entities' => true,    // Turn off if you need to show € and £

    'options' => [
        // Directories
        'font_dir'   => storage_path('fonts'),
        'font_cache' => storage_path('fonts'),
        'temp_dir'   => sys_get_temp_dir(),
        'chroot'     => realpath(base_path()),

        // PDF backend
        'pdf_backend' => 'CPDF',

        // Media & rendering
        'default_media_type'      => 'screen',
        'dpi'                     => 96,
        'enable_php'             => false,
        'enable_javascript'      => true,
        'enable_remote'          => false,
        'allowed_remote_hosts'   => null,

        // Fonts
        'default_font'            => 'serif',
        'enable_font_subsetting'  => false,

        // Paper size & orientation (A4 landscape)
        'default_paper_size'       => 'A4',
        'default_paper_orientation'=> 'landscape',

        // Margins (in points; 1pt = 1/72")
        'margin_top'              => 20,
        'margin_right'            => 10,
        'margin_bottom'           => 20,
        'margin_left'             => 10,

        // Protocols
        'allowed_protocols' => [
            'data://'  => ['rules' => []],
            'file://'  => ['rules' => []],
            'http://'  => ['rules' => []],
            'https://' => ['rules' => []],
        ],

        // Other advanced settings...
        'artifactPathValidation'  => null,
        'log_output_file'         => null,
        'font_height_ratio'      => 1.1,
        'enable_html5_parser'    => true,
    ],
];
