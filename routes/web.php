<?php



Route::get('/', function () {
    return view('welcome');
});
 // law Rotes
Route::get('/laws','LawsController@index')->name('getLaws');
Route::get('/laws/create','LawsController@create')->name('addNewLaw');
Route::post('/laws/store','LawsController@store')->name('saveLaw');
Route::get('/laws/{lawID}/edit','LawsController@edit')->name('editLaw');

// //
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
//
// Route::get('/searchArticle','LawsController@searchArticle');
// Route::get('/searchArticle/{articleNo}','LawsController@getsearchArticle')->name('getsearchArticle');
