<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/aaaaa',function(){
    dd(DB::select(DB::raw("SHOW KEYS FROM leads WHERE Key_name='leads_registrant_country_index'")));
});

Route::get('/aaaa',function(){

   //$x = DB::select(DB::raw("select column_name, data_type, character_maximum_length from information_schema.columns where table_name = 'leads'"));

    $x = DB::select(DB::raw('Show INDEX FROM leads'));
    foreach ($x as $a => $b) {
        //dd($b);
    }
    dd($x);

});

Route::get('/update_metadata_today/{date}',['uses'=>'SearchController@update_metadata_today']);

Route::post('/ajax_search_paginated',['uses'=>'SearchController@ajax_search_paginated','as'=>'ajax_search_paginated']);

Route::get('/aaa',function(){
    $v = custom_curl_errors();
    dd($v);
});

Route::get('/aaa',function(){
    dd(generateDateRange(null,null));
});

Route::get('/sss','Maintainance@async_domain');

Route::get('/' , ['uses'=>'AccountController@home' , 'as'=>'home']);

Route::get('/checknum/{num}' , ['uses' => 'ImportExport@checknum']);

Route::get('/abc' , ['uses'=>'ImportExport@validate_ph_no']);

Route::get('/verify_domains','Maintainance@verify_domains');
Route::get('/tstt','Maintainance@each_domain_verification');


Route::get('/wb',function(){
    $x = \App\Wordpress_env::all();
});

Route::get('/aa',function(){
    $csv_exists = \App\CSV::where('file_name',"2017-02-11_whois-proxies-removed.csv");
    if($csv_exists->first() !== null)
        echo('adiug iug h');
});

//Route::get('/checkWordpressStatus','Maintainance@checkWordpressStatus');

    Route::get('/fill_csv_table_default',['uses'=>'ImportExport@fill_csv_table_default','as'=>'fill_csv_table_default']);

	Route::get('/importExeclfromCron/{date}',['uses'=>'ImportExport@importExeclfromCron',
		'as'=>'importExeclfromCron']);
    
	Route::post('/signme','AccountController@signme' );

	Route::get('/lead/{email}',['uses'=>'SearchController@lead_domains']);

    Route::post('/download_csv_single_page','SearchController@download_csv_single_page');

   	Route::group(['middleware' => 'auth'],function(){

    	Route::get('importExport', 'ImportExport@importExport');

    	Route::post('/importExcel', 'ImportExport@importExcel'); // new version of import exel

        Route::get('downloadExcel', 'SearchController@downloadExcel');

        Route::get('downloadExcel2', 'SearchController@downloadExcel2');
        //Route::get('downloadExcel' , ['uses'=>'SearchController@downloadExcel','as'=>'downloadExcel']);

    	//Route::get('/search', ['uses'=>'SearchController@search','as'=>'search']);

    	Route::any('/search' , ['uses'=>'SearchController@search','as'=>'search']);
        

        Route::post('createWordpressForDomain' , ['uses'=>'SearchController@createWordpressForDomain','as'=>'createWordpressForDomain']);
        Route::post('storechkboxvariable' , ['uses'=>'SearchController@storechkboxvariable','as'=>'storechkboxvariable']);
        Route::post('removeChkedEmailfromSession' , ['uses'=>'SearchController@removeChkedEmailfromSession','as'=>'removeChkedEmailfromSession']);

    	Route::get('/myLeads/{id}',['uses'=>'SearchController@myLeads','as'=>'myLeads']);
    	Route::post('/unlockleed' , ['uses'=>'SearchController@unlockleed','as'=>'unlockleed']);

        Route::get('/manage',['uses'=>'Maintainance@manage','as'=>'manage']);

 });




Route::post('search_paginated',['uses'=>'SearchController@search_paginated','as'=>'search_paginated']);


Route::post('login', 'AccountController@login');
Route::get('logout', 'AccountController@logout');

Route::get('/404',['uses'=>'Maintainance@notfound_404','as'=>'404']);
Route::get('/500',['uses'=>'Maintainance@notfound_500','as'=>'500']);

Route::any('regredirect',['uses'=>'AccountController@regredirect','as'=>'regredirect']);
Route::any('UserList',['uses'=>'AccountController@UserList','as'=>'UserList']);
