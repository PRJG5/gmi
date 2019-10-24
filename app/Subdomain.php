<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Domain;

class Subdomain extends Model
{
    private $id;
    private $domain;

    public function __construct(String $ids , Domain $dom)
    {
        $this->$id = $ids;
        $this->$domain = $dom;
    }
    public function getId(){
        return $this->$id;
    }

    public function getDomain()
    {
        return $this->$domain;
    }
}
