<?php

use XRA\Extend\Traits\RouteTrait;

$pack=class_basename($this->getNamespace());

$item0=[
	'name'=>$pack,
	//'prefix'=>'lu'
	//'as'=>'lu.'//'trasferte.'
	//'namespace'=>null
	//'controller' =>  'LUController'
	'only'=>['index'],
	'subs'=>[
		[
			'name'=>'User',
			'param_name'=>'user',
			//'prefix'=>'user',
			//'as'=>'user',
			//'namespace'=>null,
			//'controller'=>'UserController',
			'acts'=>[
				[
					'name'=>'search',
					//'method'=>'any',
					//'act'=>'search',
					//'as'=>'.search',
				],//end act_n
			],//end acts
			'subs'=>[
				[
					'name'=>'{user}',
					'param_name'=>'',
					'as'=>null,
				//'name'=>null,
				//'namespace'=>null,
				//'as'=>null,
				//'prefix'=>'{user}',
				//'controller' => 'SearchController',
				'subs' =>[
					[
						'name'=>'Group',
						'param_name'=>'group',
						//'prefix'=>'group',
						//'as'=>'.group',
						//'namespace'=>'user',
						//'controller'=>'GroupController',
					],//end sub_n
					[
						'name'=>'PermUser',
						'param_name'=>'permuser',
						//'prefix'=>'permuser',
						//'as'=>'.permuser',
						//'namespace'=>null,
						//'controller'=>'PermUserController',
					],//end sub_n
					[
						'name'=>'Right',
						'param_name'=>'right',
					],//end sub_n
					[
						'name'=>'Area',
						'param_name'=>'area',
						//'prefix'=>'area',
						//'as'=>'.area',
						//'namespace'=>'user',
						//'controller'=>'AreaController',
					],//end sub_n
				],//end subs
				],//end sub_n
			],//end subs
		],//end sub_n
		[
			'name'=>'Area',
			'param_name'=>'area',
			//'prefix'=>'area',
			//'as'=>'area.',
			//'namespace'=>null,
			//'controller'=>'AreaController',
			'acts'=>[
				[
					'name'=>'sync',
					'as'=>'sync',
					'method'=>'get',
					'act'=>'sync',
				],//end act_n
				[
					'name'=>'upload',
					'as'=>'upload',
					'method'=>'get',
					'act'=>'upload',
				],//end act_n
				[
					'name'=>'postUpload',
					'as'=>'postUpload',
					'method'=>'post',
					'act'=>'postUpload',
				],//end act_n
				[
					'name'=>'activePlugin',
					'as'=>'activePlugin',
					'method'=>'get',
					'act'=>'activePlugin',
				],//end act_n
			],//end acts
		],//end sub_n
		[
			'name'=>'Group',
			'param_name'=>'group',
			//'prefix'=>'group',
			//'as'=>'group.',
			//'namespace'=>null,
			//'controller'=>'GroupController',
		],//end sub_n
		[
			'name'=>'Right',
			'param_name'=>'right',
			//'prefix'=>'right',
			//'as'=>'right.',
			//'namespace'=>null,
			//'controller'=>'RightController',
		],//end sub_n
	],//end subs

];

$areas_prgs=[
	$item0
];

$namespace=$this->getNamespace().'\Controllers\Admin';


Route::group([
	'prefix' => 'admin',
	'middleware' => ['web','auth'],
	'namespace'=>$namespace
	], 
	function () use ($areas_prgs) {
		//\XRA\Extend\Library\XOT::dynamic_route($areas_prgs);
		RouteTrait::dynamic_route($areas_prgs);
	}
);
