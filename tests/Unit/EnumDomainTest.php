<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Enums\Domain;
use BenSampo\Enum\Rules\EnumValue;
use App;

class EnumDomainTest extends TestCase
{
    /**
     * This test is checking if all the values of the enumeration are returned
     * True when length is 7 
     */
    public function getValue()
    {
        $length = count(Domain::getValues());
        $this->assertEquals($length , 7);
    }

    /**
     * This test tests the getter of the enumeration with a number
     */
    public function testGetKEYOne()
    {
        $this->assertEquals(Domain::getKey(1) , 'Sante_mentale');
    }

    /**
     * This test tests the getter of the enumeration with an enumeration value
     */
    public function testGetKeyTwo()
    {
        $this->assertEquals(Domain::getKey(Domain::Sante_mentale) , 'Sante_mentale');
    }

    public function testGetDescription()
    {
        App::SetLocale('fr');
        $this->assertEquals(Domain::getDescription(Domain::Sante_mentale) , 'Sante mentale');
    }

}
 