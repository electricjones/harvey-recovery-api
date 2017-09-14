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

use App\Tracker\User\User;

Route::get('/users/{uuid}', 'DashboardController@show');

Route::get('/remove-user/{id}', function ($id) {
    User::destroy($id);
    return view('removed_user');
});

Route::get("/update-answers", 'AnswersController@update');



Route::get('helpful/{user_id}', function($user_id) {
    $data = json_decode(file_get_contents(__DIR__ . "/../public/helpful.json"), true);
    $data[] = $user_id;

    file_put_contents(__DIR__ . "/../public/helpful.json", json_encode($data));

    return response("Thank you");
});


Route::get('/env', function () {
    var_dump(getenv('DB_HOST'));

    $files1 = scandir(__DIR__ . '/../');
    print_r($files1);
    echo "<br>";
});


Route::get('/latest', function (){
    $user_id = DB::table('surveys')->orderBy('created_at', 'desc')->first()->user_id;
    $hash = User::find($user_id)->hash;

    $site = \Config::get('sms.DASHBOARD_SITE_URL');

    return "Follow this link to your Recovery Status page: <a href=\"{$site}users/{$hash}\">{$site}users/{$hash}</a>";
});

Route::get("/json", function () {
    print_r(file_get_contents(storage_path('content.en.json')));
});


Route::get("/migrate", function () {
    \Illuminate\Support\Facades\Artisan::call('migrate');
});


Route::get('/check', function () {
    return [\App\Tracker\Survey\Survey::all(), \App\Tracker\User\User::all()];
});


Route::get('/clear', function () {
    foreach (\App\Tracker\Survey\Survey::all() as $survey) {
        $survey->delete();
    }

    foreach (\App\Tracker\User\User::all() as $user) {
        $user->delete();
    }
});


