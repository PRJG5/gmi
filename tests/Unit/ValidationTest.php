<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Validation;

class ValidationTest extends TestCase
{
    use RefreshDatabase;




    public function testCreation(){
        $validation = Validation::create([
            'voteNb' => 20,
            'userNb' => 69,
            'validationRate' => 80,
            'validated_at' => date('Y-m-d')
        ]);

        
        $this->assertDatabaseHas('validations', ['id'=>$validation->id]);
    }
}
