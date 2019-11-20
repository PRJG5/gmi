<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Enums\Subdomain;
use App;

class EnumSubdomainTest extends TestCase
{
    /**
     * This test is checking if all the values of the enumeration are returned
     * True when length is 7 
     */
    public function getValue()
    {
        $length = count(Subdomain::getValues());
        $this->assertTrue($length == 24);
    }

    /**
     * This test tests the getter of the enumeration with a number
     */
    public function testGetKEYOne()
    {
        $this->assertTrue(Subdomain::getKey('Justice') == 'Justice');
    }

    /**
     * This test tests the getter of the enumeration with an enumeration value
     */
    public function testGetKeyTwo()
    {
        $this->assertTrue(Subdomain::getKey(Subdomain::Justice) == 'Justice');
    }

    public function testGetDescription()
    {
        App::setLocale('fr');
        $this->assertEquals('Asile',Subdomain::getDescription('Asylum') );
    }
}
