<?php


namespace App\Http\Controllers;


use App\Imports\SubDomainsImport;
use Maatwebsite\Excel\Facades\Excel;

class SubDomainController extends Controller
{
    public static function importFile($file){

        Excel::import(new SubDomainsImport(),$file);

    }
}