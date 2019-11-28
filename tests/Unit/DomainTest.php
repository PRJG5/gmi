<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Domain;

class DomainTest extends TestCase
{
    /**
     * Check if the domain is in the database.
     */
    public function testDomainInsert()
    {
        $domain = new Domain();
        $domain->content = "Legal";
        $domain->save();
        $this->assertDatabaseHas('domains', [
            'content'=> $domain->content
        ]);
        $domain->delete();
    }

    public function testDomainDelete(){
        $domain = new Domain();
        $domain->content = "Legal";
        $domain->save();
        $idDomain = $domain->id;
        $domain->delete();
        $this->assertDatabaseMissing('domains',['id'=>$idDomain]);
        
    }

}
