<?php

use XRA\Extend\Library\XOT;

$namespace=$this->getNamespace().DIRECTORY_SEPARATOR.'Controllers';
//$pack= class_basename($this->getNamespace());
$pack='MyProfile';
$pack_low=strtolower($pack);


$item0=[
	'name'=>$pack_low,
	'prefix'=>$pack_low,
	'as'=>$pack_low.'.',
	'namespace'=>null,
	'controller' =>  $pack.'Controller',
	//'only'=>['index','show'],
	/*
	'subs'=>[
		[
			'name'=>'map',
			'prefix'=>'map',
			'as'=>'map.',
			'namespace'=>$pack_low,
			'controller'=>'MapController',
			'only'=>['index'],
		],//end sub_n
	],//end subs
	*/
];

$areas_prgs=[
	$item0
];

Route::group(['prefix' => null,'middleware' => ['web','auth'],'namespace'=>$namespace], function () use ($areas_prgs) {
	XOT::dynamic_route($areas_prgs);
});
