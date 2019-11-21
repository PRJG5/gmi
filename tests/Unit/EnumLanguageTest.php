<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\App;
use Tests\TestCase;
use App\Enums\Language;

class EnumLanguageTest extends TestCase
{
    /**
     * @test
     * Test of the number of language in the application 
     *
     * The test must be False
     */
    public function TestSizeLanguage()
    {
        $temp = Language::getKeys();
        $this->assertNotEquals(1,count($temp));
    }

    /**
     * @test
     * Check if the French language is in the enum
     * 
     */
     public function TestFindLanguage()
     {
         $temp = Language::hasKey("FRA");
         $this->assertTrue($temp);
     }

     /**
      * @test 
      * Check if there is 52 language in the enum
      */
      public function TestNumberLanguage()
      {
          $temp = Language::getValues();
          $result = count($temp);
          $this->assertEquals($result,59);
      }

    /**
     * @test
     */
    public function LanguageDescriptionTest()
    {
        App::setLocale('fr');
        $this->assertEquals('Dari', Language::getDescription('PRS'));
    }
}
