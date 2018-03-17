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

Route::get('/', function () {
    return view('welcome');
});

Route::get('role', [
    'middleware' => 'Role:admin',
    'uses' => 'TestController@index'
]);

Route::get('terminate', [
    'middleware' => 'Terminate',
    'uses' => 'ABCController@index'
]);

Route::get('profile', [
    'middleware' => 'auth',
    'uses' => 'UserController@showProfile'
]);

Route::get('/usercontroller/path', [
    'middleware' => 'First',
    'uses' => 'UserController@showPath'
]);

Route::resource('rest','RestController');

//Route::controller('test','ImplicitController');

class Classes{
    public $attr = 'attr';
}
Route::get('imply','ImplicitController@index');

Route::get('/foo/bar','UriController@index');

Route::get('/register', function(){
   return view('register'); 
});

Route::post('/user/register', array('uses' => 'Registration@postRegistration'));