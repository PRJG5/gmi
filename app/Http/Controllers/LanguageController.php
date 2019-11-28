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
        
        return view("language.index")->with(['headers'=>['id','content','slug'],'bodies'=>Language::all()]);
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

}