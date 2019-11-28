<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Phonetic;
use Illuminate\Support\Facades\DB;

class PhoneticTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testInsertDb()
    {
        $tempPho = new Phonetic();
        $str = "coucou";
        $tempPho->textDescription = $str;
        $tempPho->save();
        $verif = DB::table('phonetics')->where('textDescription', $str)->select("*")->get();
        $this->assertEquals($verif[0]->textDescription, $tempPho->textDescription);
        $tempPho->delete();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testInsertDbSpecialChar()
    {
        $tempPho = new Phonetic();
        $str = "fdeəi:ɒaʊaɪʊəʤʧŋɜ:";
        $tempPho->textDescription = $str;
        $tempPho->save();
        $verif = DB::table('phonetics')->where('textDescription', $str)->select("*")->get();
        $this->assertEquals($verif[0]->textDescription, $tempPho->textDescription);
        $tempPho->delete();
    }
    
    public function testDeleteDb(){
        $tempPho = new Phonetic();
        $str = "fdeəi:ɒaʊaɪʊəʤʧŋɜ:";
        $tempPho->textDescription = $str;
        $tempPho->save();
        $verif = DB::table('phonetics')->where('textDescription', $str)->select("*")->get();
        $this->assertEquals($verif[0]->textDescription, $tempPho->textDescription);
        $tempPho->delete();
        $this->assertDatabaseMissing('phonetics', [
            'textDescription' => $str,
        ]);
    }
}
