<?php


namespace App\Http\Controllers;


use App\Imports\DomainsImport;
use Maatwebsite\Excel\Facades\Excel;

class DomainController extends Controller
{
    public static function importFile($file){

        Excel::import(new DomainsImport(),$file);

    }
}