<?php



Route::get('/', function () {
    return view('welcome');
});
 // law Rotes
Route::get('/AddLaw','LawsController@index')->name('addNewLaw');
Route::post('/law/store','LawsController@store')->name('saveLaw');



//
Route::get('/law/addLawArticles/{lawNo}/{lawSlug}','LawArticlesController@addLawArticlesForm')->name('addArticle');
Route::post('/law/addLawArticles/store/{lawid}','LawArticlesController@store')->name('SaveArticle');

Route::get('judgments/getalljudgments','JudgmentsController@getalljudgments')->name('getalljudgments');
Route::get('judgments/create','JudgmentsController@create')->name('addJudgment');
Route::post('judgments/store','JudgmentsController@store')->name('saveJudgment');

Route::get('judgments/edit/{judgmentdid}','JudgmentsController@edit')->name('editJudgment');


Route::get('judgments/addnotes/{judgmentid}','JudgmentsController@addnotes')->name('Judgmentaddnotes');

Route::post('/judgments/saveNotes/store','JudgmentNotesController@store')->name('storeNotes');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/searchArticle','LawsController@searchArticle');
Route::get('/searchArticle/{articleNo}','LawsController@getsearchArticle')->name('getsearchArticle');


Route::get('/testview',function (){
return view('SystemLaws.AddNewLaw');
});

Route::get('/test/{no}',function ($no){

  $formatedData = [];
  $laws = [];
  $results =DB::table('law_articls')
                ->where('articleno', 'like', $no.'%')
                ->get();
                foreach ($results as $article) {
                  $attr = \App\LawArticl::find($article->id);
                  $somedata = [
                    'articleID'=>$attr->id,
                    'articleNO'=>$attr->articleno,
                    'lawID'=>$attr->law->id,
                    'lawCategory'=>$attr->law->lawcategory,
                    'lawSlug' =>$attr->law->slug,
                  ];
                  $formatedData[] = $somedata;
                }
  return $formatedData;
});
