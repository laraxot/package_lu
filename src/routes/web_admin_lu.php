<?php

$item0=[
	'name'=>'lu'
	,'prefix'=>'lu'
	,'as'=>'lu.'//'trasferte.' 
	,'namespace'=>null
	//,'controller' => 'UserController'
	,'controller' =>  'LUController'
	,'only'=>['index']
	,'subs'=>[
		[
			'name'=>'user',
			'prefix'=>'user',
			'as'=>'user',
			'namespace'=>null,
			'controller'=>'UserController',
			'acts'=>[
				[
					'name'=>'search',
					'method'=>'any',
					'act'=>'search',
					'as'=>'.search',
				],//end act_n
			],//end acts
			'subs'=>[
				[
				'name'=>null,
				'namespace'=>null,
				'as'=>null,
				'prefix'=>'{id_user}',
				'controller' => 'SearchController',
				'subs' =>[
					[
						'name'=>'group',
						'prefix'=>'group',
						'as'=>'.group',
						'namespace'=>'user',
						'controller'=>'GroupController',
					],//end sub_n
					[
						'name'=>'area',
						'prefix'=>'area',
						'as'=>'.area',
						'namespace'=>'user',
						'controller'=>'AreaController',
					],//end sub_n
				],//end subs
				],//end sub_n
			],//end subs
		],//end sub_n
		[
			'name'=>'area',
			'prefix'=>'area',
			'as'=>'area.',
			'namespace'=>null,
			'controller'=>'AreaController',
			'acts'=>[
				[
					'name'=>'sync',
					'as'=>'sync',
					'method'=>'get',
					'act'=>'sync',
				],//end act_n
			],//end acts
		],//end sub_n
		[
			'name'=>'group',
			'prefix'=>'group',
			'as'=>'group.',
			'namespace'=>null,
			'controller'=>'GroupController',
		],//end sub_n
		[
			'name'=>'right',
			'prefix'=>'right',
			'as'=>'right.',
			'namespace'=>null,
			'controller'=>'RightController',
		],//end sub_n
	],//end subs
	
];

$areas_prgs=[
	$item0
];

$namespace='\XRA\LU\Controllers\admin';

Route::group(['prefix' => 'admin','middleware' => ['web','auth'],'namespace'=>$namespace], function () use ($areas_prgs) {

\XRA\Extend\Library\XOT::dynamic_route($areas_prgs);


});
