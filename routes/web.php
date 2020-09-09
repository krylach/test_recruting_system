<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'candidate'], function () {
    Route::get('/', 'Candidate\CandidateController@index')->name('candidate.index');
    Route::get('search', 'Candidate\CandidateController@search')->name('candidate.search');
    Route::get('create', 'Candidate\CandidateController@store')->name('candidate.create');
    Route::get('{id}/delete',  'Candidate\CandidateController@destroy')->name('candidate.delete');
    Route::get('{id}/update',  'Candidate\CandidateController@update')->name('candidate.update');
});
