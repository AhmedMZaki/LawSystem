<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\judgments;
use Storage;
use Session;
use App\LawArticl;
use DB;
class JudgmentsController extends Controller
{
    public function index()
    {
        $judgments = judgments::latest()->paginate(10);
        return view('judgments.index', compact('judgments'));
    }

    public function create($lastJudgment = null)
    {
        $files =JudgmentsController::readDirectory('/public/unfinished_judgments/');
        if ($lastJudgment) {
            $lastJudgment = judgments::find($lastJudgment);
        }
        return view('judgments.createNewJudgment')->with('files', $files)->with('lastJudgment', $lastJudgment);
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

        $lastJudgment = judgments::create([
            'judgmentcategory' => $request['judgmentcategory'],
            'judgmentfile' => $request['judgmentfile'],
            'judgmentDate' => $request['judgmentDate'],
            'year' => $request['year'],
            'objectionNo' => $request['objectionNo'],
            'notes' => $request['notes'],
            'incompletednotes'=> $request['notes'],
        ]);

        if ($lastJudgment)
        {
            $suuccess = Storage::move(('public/unfinished_judgments/'.$request['judgmentfile']), ('public/Finished_Judgments/'
                .$request['judgmentfile']));
            if ($suuccess)
            {
                return redirect()->route('addJudgments',['lastJudgment'=>$lastJudgment->id]);
            }
        } else {

            return redirect()->route('addJudgments',['lastJudgment'=>$lastJudgment->id]);
        }

    }

    public function updateLastInput(Request $request,$lastJudgment)
    {
        $judgment = judgments::find($lastJudgment);
        return view('judgments.updateLastInput', compact(['judgment']));
    }

    public function saveLastInput(Request $request, $lastJudgment)
    {
        $request->validate([

            'judgmentcategory' => 'required',
            'judgmentDate' => 'required',
            'year' => 'required',
            'objectionNo' => 'required',
            'notes' => 'required',
        ]);
        $judgment = judgments::find($lastJudgment);
        $judgment->judgmentcategory = $request['judgmentcategory'];
        $judgment->judgmentDate = $request['judgmentDate'];
        $judgment->year = $request['year'];
        $judgment->objectionNo = $request['objectionNo'];
        $judgment->notes = $request['notes'];
        $judgment->save();
        if ($judgment) {
            $files = JudgmentsController::readDirectory('/public/unfinished_judgments/');
            $lastJudgment = null;
            return view('judgments.createNewJudgment')->with('files', $files)->with('lastJudgment', $lastJudgment);
        } else {
            return redirect()->back();
        }
    }

    public function getalljudgments()
    {
        $judgments =judgments::all();
        return view('laws.getalljudgments',compact('judgments'));
    }



    public function addNote(Request $request,$judgmentID)
    {
        $judgment = judgments::find($judgmentID);
        return view('judgments.addNoteTojudgment', compact(['judgment']));
    }



    public function edit(Request $request,judgments $judgmentdid)
    {
        dd($judgmentdid);
    }

    public static function readDirectory($directory)
    {
        $files = array_filter(Storage::disk('local')->files($directory),
            function ($item) {
                return strpos($item, 'pdf');
            });
        $data = [];
        $realfilesName = [];
        foreach ($files as $file) {
            $data = explode("/", $file);
            $realfilesName [] = $data[2];
        }

        return $realfilesName;
    }

    public function getLawArticles(Request $request,$articleNo)
    {
        if ($articleNo) {
            $formatedData = [];
            $laws = [];
            $results = DB::table('law_articls')
                ->where('articleno', $articleNo)
                ->get();
            foreach ($results as $article) {
                $attr = LawArticl::find($article->id);
                $somedata = [
                    'articleId' => $attr->id,
                    'info' => "    المادة رقم {$attr->articleno} من القانون ال{$attr->law->lawcategory}  ",
                ];
                $formatedData[] = $somedata;
            }
            return $formatedData;
        } else {
            return null;
        }
    }

    public function judgmentNotes(Request $request)
    {
        $request->validate([
            'judgment_id' => 'required',
            'judgrule' => 'required',
            'judgshort' => 'required',
            'lawarticles' => 'required',
        ]);

        $judgmentnotes = judgmentNotes::create([
            'judgment_id' => $request['judgment_id'],
            'judgrule' => $request['judgrule'],
            'judgshort' => $request['judgshort'],
        ]);

        $judg = judgments::find($request['judgment_id']);
        $judg->Articls()->attach($request['lawarticles']);

        return response()->json([
            'message' => "تم اضافة المادة بنجاح",
            "status" => 200
        ]);


    }


}
