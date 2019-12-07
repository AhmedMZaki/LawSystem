<?php



Route::get('/', function () {
    return view('welcome');
});

Route::get('/AddLaw','LawsController@index')->name('addNewLaw');
Route::post('/law/store','LawsController@store')->name('saveLaw');

Route::get('/law/addLawArticles/{lawNo}/{lawSlug}','LawArticlesController@addLawArticlesForm')->name('addArticle');
Route::post('/law/addLawArticles/store/{lawid}','LawArticlesController@store')->name('SaveArticle');

Route::get('judgments/getalljudgments','JudgmentsController@getalljudgments')->name('getalljudgments');
Route::get('judgments/create','JudgmentsController@create')->name('addJudgment');
Route::post('judgments/store','JudgmentsController@store')->name('saveJudgment');

Route::get('judgments/edit/{judgmentdid}','JudgmentsController@edit')->name('editJudgment');


Route::get('judgments/addnotes/{judgmentid}','JudgmentsController@addnotes')->name('Judgmentaddnotes');

Route::post('/judgments/saveNotes/store','JudgmentNotesController@store')->name('storeNotes');


Route::get('/test',function (){
    $test = \App\Law::find(1);
    return dd($test);
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
