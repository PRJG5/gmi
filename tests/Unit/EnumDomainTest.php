<?php

namespace Tests\Unit;

use App\Enums\Domain as Domain;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

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
        $this->assertEquals('MentalHealth', Domain::getKey('Mental Health'));
    }

    /**
     * This test tests the getter of the enumeration with an enumeration value
     */
    public function testGetKeyTwo()
    {
		$this->assertEquals('MentalHealth', Domain::getKey(Domain::MentalHealth));
    }

    public function testGetDescription()
    {
        App::setlocale('fr');
        $this->assertEquals('Juridique', Domain::getDescription('Legal'));
    }

}
