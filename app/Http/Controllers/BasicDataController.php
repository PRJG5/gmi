<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subdomain;

class BasicDataController extends Controller
{

    public function addSubdomain($name)
    {
        $subdomain = new Subdomain();  
        $subdomain->name=$name;
        $subdomain->save();  
    }

    public function addDomain($content)
    {
        $domain = new Domain();
        $domain->content=$content;
        $domain->save();
    }

}