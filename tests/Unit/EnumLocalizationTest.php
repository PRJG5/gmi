<?php

namespace Tests\Unit;

use App\Enums\Language;
use App;

class EnumLocalizationTest extends ApplicationTestCase 
{
    /**
     * @test
     */
    public function LanguageDescriptionTest()
    {
        App::setLocale('fr');
        $this->assertEquals('Dari', Language::getDescription('PRS'));
    }
}
