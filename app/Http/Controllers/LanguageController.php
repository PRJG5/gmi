<?php

namespace App\Http\Controllers;

use App\Language;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Imports\LanguagesImport;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view("addBasicData")->with(['headers'=>['id','content','slug'],'bodies'=>Language::orderBy('content')->get()]);
    }

    public function importView(){
        return view('language.import');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request) 
    {

        $this->validate($request,[
            'file' => 'required|mimes:xls,xlsx'
        ]);
        Excel::import(new LanguagesImport,$request->file('file'));
           
        //return redirect("/language");
    }

    public static function importFile($file){

        Excel::import(new LanguagesImport,$file);

    }

}
