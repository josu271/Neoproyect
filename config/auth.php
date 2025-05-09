<?php
return [
    'guards' => [
        'web' => [
            'driver'   => 'session',
            'provider' => 'empleados',
        ],
    ],

    'providers' => [
        'empleados' => [
            'driver' => 'eloquent',
            'model'  => App\Models\Empleado::class,
        ],
    ],
];