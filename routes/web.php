<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
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

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//---------------------------------------------------- 
// Admin middleware 
Route::resource('users', 'UserController'); // all crud methods available

Route::any('/search',function(Request $request){
    $q = $request->get( 'q' );
    if($q){
        $users = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->paginate(15);
    }else
    {   //return all users
        $users = DB::table('users')->paginate(15);
    }
    if(count($users) > 0)
    return view('users.index', compact('users'));
    else return view ('users.index')->withMessage('No Details found. Try to search again !');
});


