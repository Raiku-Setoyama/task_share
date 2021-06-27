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

Route::group(['middleware' => 'auth'],function(){

    // 個人
    Route::get('/folders/{id}/tasks','TaskController@index')->name('tasks.index');
    Route::get('/folders/create','FolderController@showCreateForm')->name('folders.create');
    Route::post('/folders/create','FolderController@create');
    Route::get('/folders/{id}/tasks/create','TaskController@showCreateForm')->name('tasks.create');
    Route::post('/folders/{id}/tasks/create','TaskController@create');
    Route::get('/folders/{id}/tasks/{task_id}/edit','TaskController@showEditForm')->name('tasks.edit');
    Route::post('/folders/{id}/tasks/{task_id}/edit','TaskController@edit');
    Route::get('/folders/{id}/tasks/{task_id}/delete','TaskController@showDeleteForm')->name('tasks.delete');
    Route::post('/folders/{id}/tasks/{task_id}/delete','TaskController@delete');
    Route::get('/folders/{id}/delete','FolderController@showDeleteForm')->name('folders.delete');
    Route::post('/folders/{id}/delete','FolderController@delete');
    Route::get('/','HomeController@index')->name('home');

    // グループ
    Route::get('/groups/{id}/folders/{folder_id}/tasks','GroupController@index')->name('groups.index');
    Route::get('/groups/{id}/folders/create','GroupFolderController@showCreateForm')->name('group_folders.create');
    Route::post('/groups/{id}/folders/create','GroupFolderController@create');
    Route::get('/groups/{id}/folders/{folder_id}/delete','GroupFolderController@showDeleteForm')->name('group_folders.delete');
    Route::post('/groups/{id}/folders/{folder_id}/delete','GroupFolderController@delete');
    Route::get('/groups/{id}/folders/{folder_id}/tasks/create','GroupTaskController@showCreateForm')->name('group_tasks.create');
    Route::post('/groups/{id}/folders/{folder_id}/tasks/create','GroupTaskController@create');
    Route::get('/groups/{id}/folders/{folder_id}/tasks/{task_id}/edit','GroupTaskController@showEditForm')->name('group_tasks.edit');
    Route::post('/groups/{id}/folders/{folder_id}/tasks/{task_id}/edit','GroupTaskController@edit');
    Route::get('/groups/{id}/folders/{folder_id}/tasks/{task_id}/delete','GroupTaskController@showDeleteForm')->name('group_tasks.delete');
    Route::post('/groups/{id}/folders/{folder_id}/tasks/{task_id}/delete','GroupTaskController@delete');
    // タスク内チャット機能
    Route::get('/groups/{id}/folders/{folder_id}/tasks/{task_id}/chat','ChatController@index')->name('chats.index');
    Route::post('/groups/{id}/folders/{folder_id}/tasks/{task_id}/chat/add','ChatController@add')->name('chat.add');
    Route::get('/result/ajax/', 'ChatController@getData');
    
    // タスクの位置情報受け取り
    Route::post('/position','TaskController@fixed');
    Route::post('/position/group','GroupTaskController@fixed');

    // グループ作成
    Route::get('/group/create','GroupController@showCreateForm')->name('groups.create');
    Route::post('/group/create','GroupController@create');

    // グループ退会
    Route::get('/group/{id}/out','GroupController@out')->name('group.out');

    // グループ検索
    Route::get('/group/search','GroupController@search')->name('groups.search');
    Route::get('/group/{id}/entry','GroupController@entry')->name('group.entry');
    
    //グループタスクを個人へ追加
    Route::get('/groups/{id}/folders/{folder_id}/tasks/{task_id}/add','TaskController@showAddForm')->name('tasks.add');
    Route::post('/groups/{id}/folders/{folder_id}/tasks/{task_id}/add','TaskController@add');

    // 管理者権限
    // 入グル許可
    Route::get('/groups/{id}/folders/{folder_id}/user/{user_id}/right','GroupController@right')->name('group.right');
    // グループ削除
    Route::post('/group/delete','GroupController@delete');
    // グループ参加キャンセル
    Route::post('/group/cancel','GroupController@cancel');

    //トップページ　グループ作成済みならタスク画面、そうでないなら作成画面へいく
    Route::get('/group/home','GroupController@home')->name('group.home');
});

// 認証機能
Auth::routes();

// 2段階認証
Route::get('two_factor_auth/login_form','TwoFactorAuthController@login_form')->name('two_factor_auth');
Route::post('ajax/two_factor_auth/first_auth', 'TwoFactorAuthController@first_auth');
Route::post('ajax/two_factor_auth/second_auth', 'TwoFactorAuthController@second_auth');



