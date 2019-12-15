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
        $files = JudgmentsController::readDirectory('/public/unfinished_judgments/');
        if ($lastJudgment) {
            $lastJudgment = judgments::find($lastJudgment);
        }
        return view('judgments.createNewJudgment')->with('files', $files)->with('lastJudgment', $lastJudgment);
    }

    public function store(Request $request)
    {

        $this->validate($request,
            [
                'judgmentfile' => 'required',
                'judgmentcategory' => 'required',
                'judgmentDate' => 'required',
                'year' => 'required',
                'objectionNo' => 'required',
                'notes' => 'required',
            ], [
                'judgmentfile.required' => 'مطلوب إدخال نص الحكم',
                'judgmentcategory.required' => 'تصنيف الحقل مطلوب',
                'judgmentDate.required' => 'تاريخ الجلسة مطلوب',
                'year.required' => 'مطلوب إدخال السنة',
                'objectionNo.required' => 'مطلوب إدخال رقم الطعن',
                'notes.required' => 'مطلوب إدخال عدد المبادئ ',
            ]);

        $lastJudgment = judgments::create([
            'judgmentcategory' => $request['judgmentcategory'],
            'judgmentfile' => $request['judgmentfile'],
            'judgmentDate' => $request['judgmentDate'],
            'year' => $request['year'],
            'objectionNo' => $request['objectionNo'],
            'notes' => $request['notes'],
            'incompletednotes' => $request['notes'],
        ]);

        if ($lastJudgment) {
            $suuccess = Storage::move(('public/unfinished_judgments/' . $request['judgmentfile']), ('public/Finished_Judgments/'
                . $request['judgmentfile']));
            if ($suuccess) {
                Session::put('notification', [
                    'message' => " تم حفظ الحكم بنجاح  ",
                    'alert-type' => 'success',
                ]);
                return redirect()->route('addJudgments', ['lastJudgment' => $lastJudgment->id]);
            }
        } else {
            Session::put('notification', [
                'message' => " خطأ فى إدخال البيانات  ",
                'alert-type' => 'error',
            ]);
            return redirect()->route('addJudgments', ['lastJudgment' => $lastJudgment->id]);
        }

    }

    public function update(Request $request, $judgmentID)
    {
        $this->validate($request,
            [
                'judgmentcategory' => 'required',
                'judgmentDate' => 'required',
                'year' => 'required',
                'objectionNo' => 'required',
                'notes' => 'required',
            ], [
                'judgmentcategory.required' => 'تصنيف الحقل مطلوب',
                'judgmentDate.required' => 'تاريخ الجلسة مطلوب',
                'year.required' => 'مطلوب إدخال السنة',
                'objectionNo.required' => 'مطلوب إدخال رقم الطعن',
                'notes.required' => 'مطلوب إدخال عدد المبادئ ',
            ]);
        $judgmentID = judgments::find($judgmentID);
        $judgmentID->judgmentcategory = $request['judgmentcategory'];
        $judgmentID->judgmentDate = $request['judgmentDate'];
        $judgmentID->year = $request['year'];
        $judgmentID->objectionNo = $request['objectionNo'];
        $judgmentID->notes = $request['notes'];
        $judgmentID->incompletednotes = $request['notes'];
        $judgmentID->save();

        if ($judgmentID) {
            Session::put('notification', [
                'message' => " تم حفظ الحكم بنجاح  ",
                'alert-type' => 'success',
            ]);
            return redirect()->route('getJudgments');
        }
    }

    public function updateLastInput(Request $request, $lastJudgment)
    {
        $judgment = judgments::find($lastJudgment);
        return view('judgments.updateLastInput', compact(['judgment']));
    }

    public function saveLastInput(Request $request, $lastJudgment)
    {
        $this->validate($request,
            [

                'judgmentcategory' => 'required',
                'judgmentDate' => 'required',
                'year' => 'required',
                'objectionNo' => 'required',
                'notes' => 'required',
            ], [
                'judgmentcategory.required' => 'تصنيف الحقل مطلوب',
                'judgmentDate.required' => 'تاريخ الجلسة مطلوب',
                'year.required' => 'مطلوب إدخال السنة',
                'objectionNo.required' => 'مطلوب إدخال رقم الطعن',
                'notes.required' => 'مطلوب إدخال عدد المبادئ ',
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
            Session::put('notification', [
                'message' => " تم حفظ الحكم بنجاح  ",
                'alert-type' => 'success',
            ]);
            return view('judgments.createNewJudgment')->with('files', $files)->with('lastJudgment', $lastJudgment);
        } else {
            Session::put('notification', [
                'message' => " خطأ فى إدخال البيانات  ",
                'alert-type' => 'error',
            ]);
            return redirect()->back();
        }
    }

    public function getalljudgments()
    {
        $judgments = judgments::all();
        return view('laws.getalljudgments', compact('judgments'));
    }

    public function edit(Request $request, judgments $judgmentID)
    {
        return view('judgments.editJudgment', compact('judgmentID'));
    }

    public function addNote(Request $request, $judgmentID)
    {
        $judgment = judgments::find($judgmentID);
        return view('judgments.addNoteTojudgment', compact(['judgment']));
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


}
