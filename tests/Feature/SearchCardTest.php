<?php

namespace Tests\Feature;

use App\User;
use App\Card;
use App\Validation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchCardTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test1()
    {
        $validation = Validation::create();
        $card1 = Card::create([
            "heading" => "Persona",
            "language_id" => "EN",
            "validation_id" => $validation->id]);
        $card2 = Card::create([
            "heading" => "Shadow",
            "language_id" => "FR",
            "validation_id" => $validation->id]);
        $card3 = Card::create([
            "heading" => "Hello",
            "language_id" => "HUY",
            "validation_id" => $validation->id]);
        $card4 = Card::create([
            "heading" => "Heyololo",
            "language_id" => "FR",
            "validation_id" => $validation->id]);
        $card5 = Card::create([
            "heading" => "Pouloulou",
            "language_id" => "EN",
            "validation_id" => $validation->id]);

        $user = User::create([
            "name" => "lolo",
            "email" => "loic.corbion@gmail.com",
            "password" => "lolofire"
        ]);
        $this->actingAs($user);
        $response = $this->get('/searchCard');
        $response->assertSeeText("Shadow");
        $response->assertSeeText("Persona");
        $response->assertSeeText("Heyololo");
        $response->assertSeeText("Pouloulou");
        $this->get('/searchCard?search=Shadow&languages=All');
        $response->assertSeeText("Shadow");
        $response->assertSeeText("FR");

        //testAllLanguageAllHeading();

        $response = $this->get('/searchCard?search=&languages=All');
        $response->assertSeeText("Shadow");
        $response->assertSeeText("Persona");
        $response->assertSeeText("Heyololo");
        $response->assertSeeText("Pouloulou");

        
        
        //testDontSeeLanguage();

        $response = $this->get('/searchCard?search=&languages=FR');
        $response->assertSeeText("Shadow");
        $response->assertSeeText("Heyololo");
        $response->assertDontSeeText("Pouloulou");
        $response->assertDontSeeText("Persona");

        $response->assertStatus(200);
    }


    
}
