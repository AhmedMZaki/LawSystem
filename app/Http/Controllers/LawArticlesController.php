<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Law;
use App\LawArticl;
class LawArticlesController extends Controller
{
    public function addLawArticlesForm(Request $request,$lawNo, $lawSlug)
    {
        $findedLaw = Law::where('lawno',$lawNo)->first();
        return view('laws.addArticlesToLaw',compact('findedLaw'));
    }

    public function store(Request $request,$lawid)
    {
        $request->validate([
            'articleno' => 'required|unique:law_articls',
            'articlebody' =>'required' ,
        ]);


        $articleLaw = new LawArticl;
        $articleLaw->laws_id = $request['lawid'];
        $articleLaw->articleno =$request['articleno'];
        $articleLaw->articlebody =$request['articlebody'];
        $articleLaw->subjectid = $request['subjectid'];
        $articleLaw->subjectitle = $request['subjectitle'];
        $articleLaw->chapterid = $request['chapterid'];
        $articleLaw->chaptertitle = $request['chaptertitle'];
        $articleLaw->sectionid = $request['sectionid'];
        $articleLaw->sectiontitle = $request['sectiontitle'];
        $articleLaw->articletitle = $request['articletitle'];
        $articleLaw->save();

        if ($articleLaw)
        {
            return response()->json([
                'message' => "تم اضافة المادة بنجاح",
                "status" => 200
            ]);
        } else {
            return response()->json([
                'message' => "هذه المادة موجودة بالفعل",
                "status" => 422
            ]);
        }



    }

}
