<?php

use App\Models\User;
use App\Models\GroupUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;
use Illuminate\Http\Request;
use App\Models\help;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/counties', function () {
    $jsonString = file_get_contents(base_path('resources/lang/en/counties.json'));
    return json_decode($jsonString, true);
});
Route::group(['middleware' => 'auth'], function () {
// get homegroup page
    Route::get('/homegroup', function () {
        return view('homegroup');
    });
// get users by county api
    Route::get('users/{county}', function ($county) {
      $users =  User::where('hometown', $county)->get();
        return json_encode($users);
    });
// group routes
Route::resource('group', App\Http\Controllers\GroupController::class);
Route::resource('groupUsers', App\Http\Controllers\GroupUsersController::class);
Route::resource('groupConversation', App\Http\Controllers\GroupConversationController::class);
Route::get('groupdelete/{id}', [App\Http\Controllers\GroupController::class, 'destroy'])->name('deleteGroup');
Route::get('/help', function () {
    return view('help');
});

Route::post('/help', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'message'=> 'required|string'
    ]);
    help::create($request->all());
    return redirect()->route('home');
})->name('save.help');
Route::get('/complains', function () {
    return view('complains');
});
    Route::post('/complains', function (Request $request) {
        $help = help::find($request->respid);
        $help->update([
            'status'=> 1,
            'response'=>$request->response,
        ]);
        return redirect()->back();
    })->name('save.response');
    Route::get('/response', function (Request $request) {
            $help_responses = help::where('user_id', Auth::user()->id)->where('status', 1)->get();
            return view('response')->with('responses', $help_responses);
    })->name('myResponse');

});
Route::get('membership/{id}', function($id){
    GroupUsers::create([
        'group_id' => $id,
        'user_id' => Auth::user()->id
    ]);
    return true;
});
