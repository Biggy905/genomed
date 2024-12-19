<?php

return [
    [
        'verb' => ['get'],
        'pattern' => 'start/index',
        'route' => 'site/index',
    ],
    [
        'verb' => ['post'],
        'pattern' => 'start/create',
        'route' => 'site/create',
    ],
    [
        'verb' => ['get'],
        'pattern' => 'statistic/index',
        'route' => 'q-r/statistic',
    ],
    [
        'verb' => ['get'],
        'pattern' => '<slug>',
        'route' => 'q-r/index',
        'defaults' => [
            'slug' => '',
        ],
    ],
];
