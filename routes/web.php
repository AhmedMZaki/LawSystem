<?php


// law Rotes
Route::get('/','LawsController@index');
Route::get('/laws','LawsController@index')->name('getLaws');
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

// judgments routes
Route::get('/judgments','JudgmentsController@index')->name('getJudgments');
Route::get('/judgments/create/{lastJudgment?}','JudgmentsController@create')->name('addJudgments');
Route::post('/judgments/store','JudgmentsController@store')->name('saveJudgments');
Route::get('/judgments/{lastJudgment}/updateLastInput','JudgmentsController@updateLastInput')->name('updateLastInput');
Route::patch('/judgments/{lastJudgment}/saveLastInput','JudgmentsController@saveLastInput')->name('saveLastInput');
Route::get('/judgments/addNote/{judgmentID}','JudgmentsController@addNote')->name('addNote');
Route::post('/judgments/saveNote/{judgmentID}','JudgmentsController@saveNote')->name('saveNote');
Route::get('/judgments/getArticles/{articleNo}','JudgmentsController@getLawArticles')->name('searchArticle');

////////////////////////////////////////

// Route::get('/laws','LawsController@index')->name('getLaws');

// Route::get('/law/addLawArticles/{lawNo}/{lawSlug}','LawArticlesController@addLawArticlesForm')->name('addArticle');
// Route::post('/law/addLawArticles/store/{lawid}','LawArticlesController@store')->name('SaveArticle');
//
// Route::get('judgments/getalljudgments','JudgmentsController@getalljudgments')->name('getalljudgments');
// Route::get('judgments/create','JudgmentsController@create')->name('addJudgment');
// Route::post('judgments/store','JudgmentsController@store')->name('saveJudgment');
//
// Route::get('judgments/edit/{judgmentdid}','JudgmentsController@edit')->name('editJudgment');
//
//
// Route::get('judgments/addnotes/{judgmentid}','JudgmentsController@addnotes')->name('Judgmentaddnotes');
//
// Route::post('/judgments/saveNotes/store','JudgmentNotesController@store')->name('storeNotes');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/asd',function(){
  $asd = Storage::exists('public/Law_PDF/asd.txt');
  return response()->json($asd);
});

Route::middleware(['auth'])->prefix('admin')->group(function () {



  });
