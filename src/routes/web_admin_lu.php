<?php



//use XRA\Extend\Traits\RouteTrait;
use XRA\Extend\Services\RouteService;

$pack = class_basename($this->getNamespace());

$item0 = [
    'name' => $pack,
    'param_name' => '',
    'subs' => [
        ['name' => 'Area', 'param_name' => 'area'],
        ['name' => 'Group', 'param_name' => 'group'],
        ['name' => 'Right', 'param_name' => 'right'],
        ['name' => 'Mail'],
        ['name' => 'Event'],
        [
            'name' => 'User', 'param_name' => 'user',
            'subs' => [
                ['name' => 'Area', 'param_name' => 'area'],
                ['name' => 'Group', 'param_name' => 'group'],
                ['name' => 'Right', 'param_name' => 'right'],
                ['name' => 'PermUser', 'param_name' => 'permuser'],
            ], //end subs
        ],
    ], //end subs
];

$areas_prgs = [
    $item0,
];

$namespace = $this->getNamespace().'\Controllers\Admin';

Route::group(
    [
    'prefix' => 'admin',
    'middleware' => ['web', 'auth'],
    'namespace' => $namespace,
    ],
    function () use ($areas_prgs,$namespace) {
        //\XRA\Extend\Library\RouteTrait::dynamic_route($areas_prgs);
        RouteService::dynamic_route($areas_prgs, null, $namespace);
    }
);
