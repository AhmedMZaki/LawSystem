<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\judgmentNotes;
use App\judgments;
class JudgmentNotesController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'judgment_id'=>'required',
            'judgrule'=>'required',
            'judgshort'=>'required',
            'lawarticles'=>'required',
        ]);

        $judgmentnotes =judgmentNotes::create([
            'judgment_id' => $request['judgment_id'],
            'judgrule' => $request['judgrule'],
            'judgshort' => $request['judgshort'],
        ]) ;

        $judg =judgments::find($request['judgment_id']);
        $judg->Articls()->attach($request['lawarticles']);
        return "ok";
        


    }
}
