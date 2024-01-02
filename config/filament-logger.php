<?php

return [
    'datetime_format' => 'Y-m-d H:i:s',
    'date_format' => 'Y-m-d',

    'activity_resource' => \Z3d0X\FilamentLogger\Resources\ActivityResource::class,

    'resources' => [
        'enabled' => true,
        'log_name' => 'Resource',
        'logger' => \Z3d0X\FilamentLogger\Loggers\ResourceLogger::class,
        'color' => 'info',
        'exclude' => [],
    ],

    'access' => [
        'enabled' => true,
        'logger' => \Z3d0X\FilamentLogger\Loggers\AccessLogger::class,
        'color' => 'danger',
        'log_name' => 'Access',
    ],

    'notifications' => [
        'enabled' => false,
        'logger' => \Z3d0X\FilamentLogger\Loggers\NotificationLogger::class,
        'color' => 'success',
        'log_name' => 'Notification',
    ],

    'models' => [
        'enabled' => false,
        'log_name' => 'Model',
        'color' => 'warning',
        'logger' => \Z3d0X\FilamentLogger\Loggers\ModelLogger::class,
        'register' => [],
        'exclude' => [],
    ],

    'custom' => [],
];
