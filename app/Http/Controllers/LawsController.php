<?php

namespace App\Http\Controllers;

use App\Law;
use Storage;
use App\LawArticl;
use Session;
use DB;
use Illuminate\Http\Request;

class LawsController extends Controller
{
  // index methos gets all laws to show them in index page
    public function index()
    {
        $laws = Law::latest()->paginate(10);
        return view('SystemLaws.index',compact('laws'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'lawtype' => 'required',
            'lawcategory' => 'required',
            'lawno' => 'required|unique:laws|max:255',
            'lawyear' => 'required',
            'lawrelation' => 'required',
        ]);

        $lawId = Law::create([
            'lawtype' => $request['lawtype'],
            'lawcategory' => $request['lawcategory'],
            'lawno' => $request['lawno'],
            'lawyear' => $request['lawyear'],
            'lawrelation' => $request['lawrelation'],
            'slug' => LawsController::make_slug($request['lawrelation'])

        ]);

        if (request()->hasFile('lawfile')) {
            // get the file name with extention
            $covernamewithEXT=$request->file('lawfile')->getClientOriginalName();
            // get just the file name
            $filename=pathinfo($covernamewithEXT,PATHINFO_FILENAME);
            // get just the extention
            $extention=$request->file('lawfile')->getClientOriginalExtension();
            // file to store
            $fileNmaeToStore= $lawId->slug.'_'.time().'.'.$extention;
            // upload image
            $path=$request->file('lawfile')->storeAs('public/Law_PDF',$fileNmaeToStore);

//          $path = Storage::putFis le('public/files', $request->file('lawfile'),'public');
            $lawId->lawfile = $fileNmaeToStore;
            $lawId->save();
            return redirect()->route('addArticle', ['lawNo'=>$lawId->lawno,'lawSlug'=>$lawId->slug])->with([
              'type'=> 'success',
              'message' => 'تم إضافة القانون بنجاح'
            ]);
        } else {

            return redirect()->route('addArticle', ['lawNo'=>$lawId->lawno,'lawSlug'=>$lawId->slug])->with([
              'type'=> 'success',
              'message' => 'تم إضافة القانون بنجاح'
            ]);
        }

    }

    // return view to create / add new law
    public function create()
    {
      return view('SystemLaws.createNewLaw');
    }

    public function edit(Law $lawID)
    {
      return view('SystemLaws.editSelectedLaw',compact('lawID'));
    }

    public function update(Request $request,Law $lawID)
    {
      $request->validate([
          'lawtype' => 'required',
          'lawcategory' => 'required',
          'lawno' => 'required|unique:laws|max:255',
          'lawyear' => 'required',
          'lawrelation' => 'required',
      ]);

      $lawID->lawtype = $request['lawtype'];
      $lawID->lawcategory = $request['lawtype'];
      $lawID->lawno = $request['lawtype'];
      $lawID->lawyear = $request['lawtype'];
      $lawID->lawrelation = $request['lawtype'];

      if (request()->hasFile('lawfile')) {

        if ($request->file('lawfile')->getClientOriginalExtension() != $lawID->lawfile) {
          // move old file before adding new one
          Storage::move(('public/Law_PDF/'.$lawID->lawfile), ('public/files/'
              .$lawID->lawfile);

          // adding the new file
          $covernamewithEXT=$request->file('lawfile')->getClientOriginalName();
          // get just the file name
          $filename=pathinfo($covernamewithEXT,PATHINFO_FILENAME);
          // get just the extention
          $extention=$request->file('lawfile')->getClientOriginalExtension();
          // file to store
          $fileNmaeToStore= $lawId->slug.'_'.time().'.'.$extention;
          // upload image
          $path=$request->file('lawfile')->storeAs('public/Law_PDF',$fileNmaeToStore);
          $lawID->lawfile = $fileNmaeToStore;
          $lawID->save();
          return redirect()->route('getLaws')->with([
            'type'=> 'success',
            'message' => 'تم إضافة القانون بنجاح'
          ]);
        } else {

          $lawID->save();
          return redirect()->route('getLaws')->with([
            'type'=> 'success',
            'message' => 'تم إضافة القانون بنجاح'
          ]);
        }

    }

    public function searchArticle()
    {
      return view('searchArticle');
    }

      public function getsearchArticle(Request $request,$articleNo)
      {
        $formatedData = [];
        $laws = [];
        $results =DB::table('law_articls')
                      ->where('articleno', 'like', $articleNo.'%')
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
      }

      public static function make_slug($string, $separator = '-')
      {
          $string = trim($string);
          $string = mb_strtolower($string, 'UTF-8');

          $string = preg_replace("/[^a-z0-9_\s-۰۱۲۳۴۵۶۷۸۹ءاآؤئبپتثجچحخدذرزژسشصضطظعغفقکكگگلمنوهی]/u", '', $string);

          $string = preg_replace("/[\s-_]+/", ' ', $string);

          $string = preg_replace("/[\s_]/", $separator, $string);

          return $string;
      }

}
