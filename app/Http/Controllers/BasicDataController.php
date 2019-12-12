<?php

namespace App\Http\Controllers;

use App\Card;
use Illuminate\Http\Request;
use App\Subdomain;
use App\Language;
use App\Domain;

class BasicDataController extends Controller
{

    public function checkVedette(Request $request){
        $card = Card::where('heading','=',$request->vedette)->where('delete','=','0')->whereNotNull('validation_id')->first();
        if($card != null){
            return $card;
        }else{
            return ["status" => "SUCCESS", "type" => "", "message" => "" ];
        }
    }

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

    public function addLanguage($name, $iso, $isSigned) {
        if (Language::where('content', '=', $name)->count() > 0) {
            return json_encode(array('error' => 'Name already saved'));
        }
        if (Language::where('slug', '=', $iso)->count() > 0) {
            return json_encode(array('error' => 'Slug already saved'));
        }
        $language = new Language();
        $language->content = $name;
        $language->slug = $iso;
        $language->isSigned = $isSigned;
        $language->save();
        return json_encode(array('success' => 'Save'));
    }

    public function addDomain($content)
    {
        if (Domain::where('content', '=', $content)->count() > 0) {
            return json_encode(array('error' => 'Domain already saved'));
        }
        $domain = new Domain();
        $domain->content=$content;
        $domain->save();
        return json_encode(array('success' => 'Save'));
    }

}