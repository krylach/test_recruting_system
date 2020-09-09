<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'candidate', 'middleware' => 'auth:api'], function () {
    Route::ANY('/', 'Candidate\CandidateController@index')->name('candidate.index');
    Route::ANY('search', 'Candidate\CandidateController@search')->name('candidate.search');
    Route::POST('create', 'Candidate\CandidateController@store')->name('candidate.create');
    Route::DELETE('{id}/delete',  'Candidate\CandidateController@destroy')->name('candidate.delete');
    Route::PUT('{id}/update',  'Candidate\CandidateController@update')->name('candidate.update');
});
