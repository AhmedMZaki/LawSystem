<?php


// law Rotes
Route::get('/','LawsController@index');
Route::get('laws', 'LawsController@index')->name('getLaws');
Route::get('laws-list', 'LawsController@lawsList');
Route::get('/laws/create','LawsController@create')->name('addNewLaw');
Route::post('/laws/store','LawsController@store')->name('saveLaw');
Route::get('/laws/{lawID}/edit','LawsController@edit')->name('editLaw');
Route::patch('/laws/{lawID}/update','LawsController@update')->name('updateLaw');
Route::delete('/law/delete/{lawID}','LawsController@destory')->name('delteLaw');
Route::get('/laws/{lawID}/addArticles','LawsController@AddArticles')->name('addArticle');
Route::post('/laws/SaveLawArticle', 'LawsController@SaveLawArticles')->name('SaveLawArticle');
Route::get('/laws/{law}/showArticles', 'LawsController@showArticles')->name('showrticles');
Route::get('/laws/{articleID}/editArticle', 'LawsController@editArticle')->name('editArticle');
Route::patch('/laws/{articleID}/updateArticle', 'LawsController@updateArticle')->name('updateArticle');
Route::delete('/laws/{articleID}/deleteArticle', 'LawsController@deleteArticle')->name('deleteArticle');
Route::get('/laws/{lawID}/off', 'LawsController@lawOFF')->name('lawOFF');
Route::get('/laws/{lawID}/on', 'LawsController@lawON')->name('lawON');
Route::get('/laws/SearchArticles/{articleNo}', 'LawsController@SearchArticles')->name('searchArticle');

// judgments routes


Route::get('/judgments', 'JudgmentsController@index')->name('getJudgments');
Route::get('judgments-list', 'JudgmentsController@judgmentsList');
Route::get('/judgments/create/{lastJudgment?}','JudgmentsController@create')->name('addJudgments');
Route::post('/judgments/store','JudgmentsController@store')->name('saveJudgments');
Route::get('/judgments/{lastJudgment}/updateLastInput','JudgmentsController@updateLastInput')->name('updateLastInput');
Route::patch('/judgments/{lastJudgment}/saveLastInput','JudgmentsController@saveLastInput')->name('saveLastInput');
Route::get('/judgments/{judgmentID}/edit', 'JudgmentsController@edit')->name('editJudgment');
Route::patch('/judgments/{JudgmentID}/update', 'JudgmentsController@update')->name('updateJudgment');
Route::get('/judgments/addNote/{judgmentID}','JudgmentsController@addNote')->name('addNote');
Route::post('/judgments/saveNote/{judgmentID}','JudgmentsController@saveNote')->name('saveNote');


////////////////////////////////////////



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


