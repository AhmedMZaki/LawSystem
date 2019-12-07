<?php

namespace App\Http\Controllers;

use App\Law;
use Storage;
use Illuminate\Http\Request;

class LawsController extends Controller
{
    public function index()
    {

        return view('laws.addNewLaw');
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
            return redirect()->route('addArticle', ['lawNo'=>$lawId->lawno,'lawSlug'=>$lawId->slug]);
        } else {

            return redirect()->route('addArticle', ['lawNo'=>$lawId->lawno,'lawSlug'=>$lawId->slug]);
        }

    }



}
