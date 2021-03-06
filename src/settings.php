<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        'upload_directory_pelatih' => __DIR__ . '/../public/uploads/pelatih', // upload directory pleatih
        'upload_directory_sanggar' => __DIR__ . '/../public/uploads/sanggar', // upload directory sanggar
        
        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Database Settings
        'db' => [
            'host' => 'localhost',
            'user' => ' root',
            'pass' => '',
            'dbname' => 'silat',
            'driver' => 'mysql'
        ]
    ],
];
