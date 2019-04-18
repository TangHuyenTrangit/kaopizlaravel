<?php
use App\TheLoai;
use App\Http\Controllers\TheLoaiController;

Route::get('admin/dangnhap','UserController@getDangnhapAdmin');
Route::post('admin/dangnhap','UserController@postDangnhapAdmin');
Route::get('admin/logout','UserController@getDangxuatAdmin');
Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function()
	{
		Route::group(['prefix'=>'theloai'],function()
		{
			Route::get('danhsach','TheLoaiController@getDanhsach');
			Route::get('sua/{id}','TheLoaiController@getSua');
			Route::post('sua/{id}','TheLoaiController@postSua');
			Route::get('them','TheLoaiController@getThem');
			Route::post('them','TheLoaiController@postThem');
			Route::get('xoa/{id}','TheLoaiController@getXoa');

		});

		Route::group(['prefix'=>'tintuc'],function()
		{
			Route::get('danhsach','TinTucController@index');
			Route::get('sua/{id}','TinTucController@edit');
			Route::post('sua/{id}','TinTucController@update');
			Route::get('them','TinTucController@create');
			Route::post('them','TinTucController@store');
			Route::get('xoa/{id}','TinTucController@destroy');

		});
		Route::group(['prefix'=>'comment'],function()
		{
			
			Route::get('xoa/{id}/{idTinTuc}','CommentController@destroy');

		});



		Route::group(['prefix'=>'loaitin'],function()
		{
			Route::get('danhsach','LoaiTinController@getDanhsach');
			Route::get('sua/{id}','LoaiTinController@getSua');
			Route::post('sua/{id}','LoaiTinController@postSua');
			Route::get('them','LoaiTinController@getThem');
			Route::post('them','LoaiTinController@postThem');
			Route::get('xoa/{id}','LoaiTinController@getXoa');
		});
		Route::group(['prefix'=>'slide'],function()
		{
			Route::get('danhsach','SlideController@index');
			Route::get('sua/{id}','SlideController@edit');
			Route::post('sua/{id}','SlideController@update');
			Route::get('them','SlideController@create');
			Route::post('them','SlideController@store');
			Route::get('xoa/{id}','SlideController@destroy');
		});
			Route::group(['prefix'=>'user'],function()
		{
			Route::get('danhsach','UserController@index');
			Route::get('sua/{id}','UserController@edit');
			Route::post('sua/{id}','UserController@update');
			Route::get('them','UserController@create');
			Route::post('them','UserController@store');
			Route::get('xoa/{id}','UserController@destroy');
		});

		Route::group(['prefix'=>'ajax'],function()
		{
			Route::get('loaitin/{idTheLoai}','AjaxController@getLoaiTin');
		});
	
	});

Route::get('trangchu','PageController@trangchu');
Route::get('lienhe','PageController@lienhe');
		