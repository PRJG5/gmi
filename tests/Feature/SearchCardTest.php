<?php

namespace Tests\Feature;

use App\User;
use App\Card;
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
        $card1 = Card::create([
            'heading' => 'Persona',
            'language_id' => 'EN']);
        $card2 = Card::create([
            'heading' => 'Shadow',
            'language_id' => 'FR'])->create();
        $card3 = Card::create([
            'heading' => 'Hello',
            'language_id' => 'HUY'])->create();
        $card4 = Card::create([
            'heading' => 'Heyololo',
            'language_id' => 'FR'])->create();
        $card5 = Card::create([
            'heading' => 'Pouloulou',
            'language_id' => 'EN'])->create();

        $user = User::create([
            'name' => 'lolo',
            'email' => 'loic.corbion@gmail.com',
            'password' => 'lolofire'
        ]);
        $this->actingAs($user);
        $response = $this->get('/allCards');
        $response->assertSeeText('Shadow');
        $response->assertSeeText('Persona');
        $response->assertSeeText('Heyololo');
        $response->assertSeeText('Pouloulou');
        $this->get('/allCards?search=Shadow&languages=All');
        $response->assertSeeText('Shadow');
        $response->assertSeeText('FR');

        //testAllLanguageAllHeading();

        $response = $this->get('/allCards?search=&languages=All');
        $response->assertSeeText('Shadow');
        $response->assertSeeText('Persona');
        $response->assertSeeText('Heyololo');
        $response->assertSeeText('Pouloulou');

        
        
        //testDontSeeLanguage();

        $response = $this->get('/allCards?search=&languages=FR');
        $response->assertSeeText('Shadow');
        $response->assertSeeText('Heyololo');
        $response->assertDontSeeText('Pouloulou');
        $response->assertDontSeeText('Persona');

        $response->assertStatus(200);
    }


    
}
