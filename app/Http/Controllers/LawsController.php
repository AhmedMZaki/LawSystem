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
            'lawno' => 'required|unique:laws',
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
            $fileNmaeToStore= $lawId->lawno.'.'.$extention;
            // upload file
            if(!Storage::exists('public/Law_PDF/'.$covernamewithEXT))
            {
              $path = Storage::move('public/files/'.$covernamewithEXT,'public/Law_PDF/'.$fileNmaeToStore);
              $lawId->lawfile = $fileNmaeToStore;
              $lawId->save();
        return redirect()
        ->route('getLaws')->with('laws',Law::latest()->paginate(10));
            } else {
              return back();
            }
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
          'lawno' => 'required',
          'lawyear' => 'required',
          'lawrelation' => 'required',
      ]);

      $lawID->lawtype = $request['lawtype'];
      $lawID->lawcategory = $request['lawcategory'];
      $lawID->lawno = $request['lawno'];
      $lawID->lawyear = $request['lawyear'];
      $lawID->lawrelation = $request['lawrelation'];
      $lawID->slug = LawsController::make_slug($request['lawrelation']);

      if (request()->hasFile('lawfile')) {

        if(Storage::exists('public/Law_PDF/'.$request->file('lawfile')->getClientOriginalExtension()))
        {
          $lawID->save();
          return redirect()->route('getLaws')->with('laws',Law::latest()->paginate(10));
        } else {
          Storage::move(('public/Law_PDF/'.$lawID->lawfile), ('public/files/'.time().'_'.'old'.'_'.$lawID->lawfile));
          // adding the new file
          $covernamewithEXT=$request->file('lawfile')->getClientOriginalName();
          // get just the file name
          $filename=pathinfo($covernamewithEXT,PATHINFO_FILENAME);
          // get just the extention
          $extention=$request->file('lawfile')->getClientOriginalExtension();
          // file to store
          $fileNmaeToStore= $lawID->lawno.'.'.$extention;
          // upload file
          Storage::move(('public/files/'.$covernamewithEXT),('public/Law_PDF/'.$fileNmaeToStore));

          $lawID->lawfile = $fileNmaeToStore;
         
        }
         
         }
         $lawID->save();
         return redirect()->route('getLaws')->with('laws',Law::latest()->paginate(10));
      }


    public function destory(Law $lawID)
    {
      // $LawID->lawArticles->delete();
      //   $LawID->delete();
      return back();
    }
    public function searchArticle()
    {
      return view('searchArticle');
    }

    public function AddArticles(Request $request,Law $lawID)
    {
      return back();
    }

    public function SaveLawArticle(Request $request,Law $lawID)
    {
      return back();
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
