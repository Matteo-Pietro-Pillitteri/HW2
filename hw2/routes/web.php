<?php

use Illuminate\Support\Facades\Route;
use App\Models\Phone;
use App\Models\Cinema;
use App\Models\Film;
use App\Models\Person;
use App\Models\LikesCinema;
use App\Models\CommentsCinema;
use App\Models\Worker;
use App\Models\Genre;
use App\Models\Favourite;
use App\Models\Employee;
use App\Models\Employment;
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

Route::get("login", "LoginController@login");
Route::get("login/check_job_email/{email}", "LoginController@checkJEm");
Route::get("login/check_user_email/{email}", "LoginController@checkUEm");
Route::get("login/check_job_password/{password}/{email}", "LoginController@checkJPsw");
Route::get("login/check_user_password/{password}/{email}", "LoginController@checkUPsw");
Route::post("login", "LoginController@checkLogin");
Route::get("logout", "LoginController@logout");

Route::get("register", "RegisterController@signup");
Route::post("register", "RegisterController@new");
Route::get("register/check/username/{user}", "RegisterController@checkUsername");
Route::get("register/check/cf/{cf}", "RegisterController@checkCf");
Route::get("register/check/jobemail/{email}", "RegisterController@checkJobEmail");
Route::get("register/check/useremail/{email}", "RegisterController@checkUserEmail");

Route::get("/home", "HomeController@show");

Route::get("film", "filmController@show");
Route::get("film/now", "filmController@post");
Route::get("film/titoli", "filmController@takeTitle");
Route::get("film/fetch_favourites", "filmController@fetching");
Route::get("film/favourites/add/{title}", "filmController@add");
Route::get("film/favourites/remove/{title}", "filmController@remove");
Route::get("film/api/omdb/{title}", "filmController@omdbApi");
Route::get("film/set_time/{time}/{title}", "filmController@setTime");
Route::get("film/add/genre/{genre}/{title}", "filmController@setGenre");
Route::get("film/api/spotify/{title}", "filmController@spotifyApi");
Route::get("film/api/tmdb", "filmController@tmdbApi");

Route::get("contattaci", "ContactController@show");
Route::get("contattaci/contatti", "ContactController@contatti");
Route::get("contattaci/aziende", "ContactController@aziende");

Route::get("sedi", "SediController@show");
Route::get("sedi/all", "SediController@all");
Route::get("sedi/check_like", "SediController@checkLike");
Route::get("sedi/like/{cod}", "SediController@like");
Route::get("sedi/unlike/{cod}", "SediController@unlike");
Route::get("sedi/show_comments/{cod}", "SediController@showComments");
Route::get("sedi/send_comment/{cod}/{text}", "SediController@sendComment");
Route::get("sedi/show_latest/{cod}", "SediController@showLatest");
Route::get("sedi/sale/{cod}", "SediController@saleCinema");
Route::get("sedi/show_likes/{cod}", "SediController@showLikes");
Route::get("sedi/search/{citta}/{regione}", "SediController@search");

Route::get("staff", "StaffController@index");
Route::post("staff/operations", "StaffController@operations");
Route::post("staff/delicate", "StaffController@delicate");

