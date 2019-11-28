<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subdomain;
use App\Language;

class BasicDataController extends Controller
{

    public function addSubdomain($name)
    {
        if (Subdomain::where('content', '=', $name)->count() > 0) {
            return json_encode(array('error' => 'Already saved'));
        }
        $subdomain = new Subdomain();  
        $subdomain->content=$name;
        $subdomain->save();
        return json_encode(array('success' => 'Save'));
    }

    public function addLanguage($name, $iso) {
        if (Language::where('content', '=', $name)->count() > 0) {
            return json_encode(array('error' => 'Name already saved'));
        }
        if (Language::where('slug', '=', $iso)->count() > 0) {
            return json_encode(array('error' => 'Slug already saved'));
        }
        $language = new Language();
        $language->content = $name;
        $language->slug = $iso;
        $language->save();
        return json_encode(array('success' => 'Save'));
    }



}