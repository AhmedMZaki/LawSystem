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
    // index method gets all laws to show them in index page
    public function index()
    {
        $laws = Law::latest()->paginate(10);
        return view('SystemLaws.index', compact('laws'));
    }

    // store method used to save the new law
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'lawtype' => 'required',
                'lawcategory' => 'required',
                'lawno' => 'required|unique:laws',
                'lawyear' => 'required',
                'lawrelation' => 'required',
            ], [   // change the default error messages from english to arabic
                'lawno.required' => 'مطلوب إدخال رقم القانون',
                'lawno.unique' => " القانون رقم " . $request['lawno'] . " موجود بالفعل  ",
                'lawtype.required' => 'مطلوب إخال نوع القانون',
                'lawcategory.required' => 'مطلوب إدخال تصنيف القانون',
                'lawyear.required' => 'مطلوب إدخال سنة القانون',
                'lawrelation.required' => 'القانون بشأن ماذا',
            ]);

        $lawId = Law::create($request->all());
        $lawId->slug = LawsController::make_slug($request['lawrelation']);

        // check if the $request has a file
        // Note:: the lawfile column is nullable
        if (request()->hasFile('lawfile')) {
            // get the file name with extention
            $covernamewithEXT = $request->file('lawfile')->getClientOriginalName();
            // get just the file name
            $filename = pathinfo($covernamewithEXT, PATHINFO_FILENAME);
            // get just the extention
            $extention = $request->file('lawfile')->getClientOriginalExtension();
            // file to store
            $fileNmaeToStore = "_قانون رقم_" . $lawId->lawno . '.' . $extention;
            // upload file
            if (!(Storage::exists('public/Law_PDF/' . $covernamewithEXT))) {
                $path = Storage::move('public/files/' . $covernamewithEXT, 'public/Law_PDF/' . $fileNmaeToStore);
                $lawId->lawfile = $fileNmaeToStore;
                $lawId->save();

            }
        }
        // check the creation of the new law is done
        // return success message
        if ($lawId) {
            Session::put('notification', [
                'message' => " تم إضافة القانون بنجاح ",
                'alert-type' => 'success',
            ]);
            return redirect()->route('addArticle', ['lawID' => $lawId]);
        } else {
            Session::put('notification', [
                'message' => " خطأ القانون موجود بالفعل ",
                'alert-type' => 'error',
            ]);

            // if the creation of new law is fails redirect it back
            return redirect()->route('addNewLaw');
        }


    }

    // return view to create / add new law
    public function create()
    {
        return view('SystemLaws.createNewLaw');
    }

    // return view to edit law
    public function edit(Law $lawID)
    {
        return view('SystemLaws.editSelectedLaw', compact('lawID'));
    }

    public function update(Request $request, Law $lawID)
    {
        $this->validate($request,
            [
                'lawtype' => 'required',
                'lawcategory' => 'required',
                'lawno' => 'required',
                'lawyear' => 'required',
                'lawrelation' => 'required',
            ], [  // change the default english error validation messages with arabic ones
                'lawno.required' => 'مطلوب إدخال رقم القانون',
                'lawtype.required' => 'مطلوب إخال نوع القانون',
                'lawcategory.required' => 'مطلوب إدخال تصنيف القانون',
                'lawyear.required' => 'مطلوب إدخال سنة القانون',
                'lawrelation.required' => 'القانون بشأن ماذا',
            ]);

        $lawID->lawtype = $request['lawtype'];
        $lawID->lawcategory = $request['lawcategory'];
        $lawID->lawno = $request['lawno'];
        $lawID->lawyear = $request['lawyear'];
        $lawID->lawrelation = $request['lawrelation'];
        $lawID->slug = LawsController::make_slug($request['lawrelation']);

        // check if the request has file
        // if file is changed then
        if (request()->hasFile('lawfile')) {
            // if the new file is exists on the law files folder
            // then save and do nothing & return direct back with success message
            if (Storage::exists('public/Law_PDF/' . $request->file('lawfile')->getClientOriginalExtension())) {
                $lawID->save();
                return redirect()->route('getLaws')->with('laws', Law::latest()->paginate(10));
            } else {
                // if the request has new file is different from the old one change the file
                Storage::move(('public/Law_PDF/' . $lawID->lawfile), ('public/files/' . time() . '_' . 'old' . '_' . $lawID->lawfile));
                // adding the new file
                $covernamewithEXT = $request->file('lawfile')->getClientOriginalName();
                // get just the file name
                $filename = pathinfo($covernamewithEXT, PATHINFO_FILENAME);
                // get just the extention
                $extention = $request->file('lawfile')->getClientOriginalExtension();
                // file to store
                $fileNmaeToStore = $lawID->lawno . '.' . $extention;
                // upload file
                Storage::move(('public/files/' . $covernamewithEXT), ('public/Law_PDF/' . $fileNmaeToStore));

                $lawID->lawfile = $fileNmaeToStore;

            }

        }
        $lawID->save();
        Session::put('notification', [
            'message' => " تم تعديل القانون رقم  " . $lawID->lawno,
            'alert-type' => 'success',
        ]);
        return redirect()->route('getLaws');
    }


    public function destory(Law $lawID)
    {
//        $LawID->lawArticles->delete();
//        $LawID->delete();
        return back();
    }

    // laravel doesn't support arabic slug so this method is used to generate arabic ones
    public static function make_slug($string, $separator = '-')
    {
        $string = trim($string);
        $string = mb_strtolower($string, 'UTF-8');

        $string = preg_replace("/[^a-z0-9_\s-۰۱۲۳۴۵۶۷۸۹ءاآؤئبپتثجچحخدذرزژسشصضطظعغفقکكگگلمنوهی]/u", '', $string);

        $string = preg_replace("/[\s-_]+/", ' ', $string);

        $string = preg_replace("/[\s_]/", $separator, $string);

        return $string;
    }


    public function AddArticles(Request $request, Law $lawID)
    {
        return view('SystemLaws.addArticleToLaw', compact('lawID'));
    }

    public function SaveLawArticles(Request $request)
    {
        $this->validate($request,
            [
                'articleno' => 'required',
                'articlebody' => 'required',
            ], [
                'articleno.required' => 'مطلوب إدخال رقم المادة',
                'articlebody.required' => 'مطلوب إدخال نص المادة',
            ]);
        $results = LawArticl::where('articleno', $request['articleno'])->get();

        if ($results) {
            foreach ($results as $result) {
                if ($result->laws_id == $request['laws_id']) {
                    return response()->json([
                        'message' => "هذه المادة موجودة بالفعل",
                        "status" => 422
                    ]);
                }
            }
        }
        $articleLaw = LawArticl::create($request->all());

        if ($articleLaw) {
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

    public function showArticles(Law $law)
    {
        $articles = $law->lawArticles;
        return view('SystemLaws.showArticles', compact(['law', 'articles']));
    }


    public function editArticle(LawArticl $articleID)
    {
        return view('SystemLaws.editArticle', compact('articleID'));
    }

    public function updateArticle(Request $request, LawArticl $articleID)
    {

        $this->validate($request,
            [
                'articleno' => 'required',
                'articlebody' => 'required',
            ], [
                'articleno.required' => 'مطلوب إدخال رقم المادة',
                'articlebody.required' => 'مطلوب إدخال نص المادة',
            ]);

        $articleID->articleno = $request['articleno'];
        $articleID->articlebody = $request['articlebody'];
        $articleID->subjectid = $request['subjectid'];
        $articleID->subjectitle = $request['subjectitle'];
        $articleID->chapterid = $request['chapterid'];
        $articleID->chaptertitle = $request['chaptertitle'];
        $articleID->sectionid = $request['sectionid'];
        $articleID->sectiontitle = $request['sectiontitle'];
        $articleID->articletitle = $request['articletitle'];
        $articleID->save();

        if ($articleID) {
            $articleID->delete();
            Session::put('notification', [
                'message' => " تم تعديل المادة بنجاح  ",
                'alert-type' => 'success',
            ]);
            return redirect()->route('showrticles', ['law' => $articleID->law]);
        } else {
            return back();
        }

    }

    public function deleteArticle(LawArticl $articleID)
    {
        $articleID->delete();
        Session::put('notification', [
            'message' => " تم حذف المادة بنجاح  ",
            'alert-type' => 'success',
        ]);
        return redirect()->back();
    }

    public function SearchArticles(Request $request, $articleNo)
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
                    'info' => " المادة رقم {$attr->articleno} من القانون ال{$attr->law->lawcategory} ",
                ];
                $formatedData[] = $somedata;
            }
            return $formatedData;
        } else {
            return null;
        }
    }

}
