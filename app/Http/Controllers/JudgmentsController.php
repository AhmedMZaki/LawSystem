<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\judgments;
use Storage;
class JudgmentsController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function create()
    {

        $files =JudgmentsController::readDirectory('/public/files/');

       return view('laws.addJudgments')->with('files', $files);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judgmentfile' => 'required',
            'judgmentcategory' => 'required',
            'judgmentDate' => 'required',
            'year' => 'required',
            'objectionNo' => 'required',
            'notes' => 'required',
        ]);

        $Judgment = judgments::create([
            'judgmentcategory' => $request['judgmentcategory'],
            'judgmentfile' => $request['judgmentfile'],
            'judgmentDate' => $request['judgmentDate'],
            'year' => $request['year'],
            'objectionNo' => $request['objectionNo'],
            'notes' => $request['notes'],
        ]);

        if ($Judgment)
        {
            $suuccess = Storage::move(('public/files/'.$request['judgmentfile']), ('public/Finished_Judgments/'
                .$request['judgmentfile']));
            if ($suuccess)
            {
                return redirect()->back();
//            return response()->json([
//                "message" => "ok chack your file directory"
//            ]);
            } else {
                return redirect()->back();
            }


        } else {
            return response()->json([
                "message" => "error"
            ]);
        }

    }
    public function getalljudgments()
    {
        $judgments =judgments::all();
        return view('laws.getalljudgments',compact('judgments'));
    }



    public function addnotes(Request $request,judgments $judgmentid)
    {
        return view('laws.addnotestojudgment',compact('judgmentid'));
    }



    public function edit(Request $request,judgments $judgmentdid)
    {
        dd($judgmentdid);
    }

    public static function readDirectory($directory)
    {
      $files = array_filter(Storage::disk('local')->files($directory),
          function ($item) {return strpos($item, 'pdf');});
      $data = [];
     $realfilesName = [];
      foreach ($files as $file)
      {
          $data= explode ("/", $file);
          $realfilesName [] = $data[2];
      }

      return $realfilesName;
    }






}
