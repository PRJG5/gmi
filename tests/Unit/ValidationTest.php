<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Validation;

class ValidationTest extends TestCase
{
    use RefreshDatabase;

  

    /**
     * Test if the validation has been created into DB
     * @return void
     * @author 49222, 44424
     * @test
     */
    public function createValidation(){
        $validation = Validation::create([
            'voteNb' => 20,
            'userNb' => 69,
            'validationRate' => 80,
            'validated_at' => date('Y-m-d')
        ]);
        $this->assertDatabaseHas('validations', ['id'=>$validation->id]);
    }

    /**
     * Test if the validation has been updated into DB
     * @return void
     * @author 49222, 44424
     * @test
     */
    public function updateValidation(){
        $voteNb = NULL;
        $validation = Validation::create([
            'voteNb' => 20,
            'userNb' => 69,
            'validationRate' => 80,
            'validated_at' => date('Y-m-d')
        ]);
        $this->assertDatabaseHas('validations', ['id'=>$validation->id, 'voteNb'=>$validation->voteNb]);
        $validation->voteNb = $voteNb;
        $validation->update();
        $this->assertDatabaseHas('validations', ['id'=>$validation->id, 'voteNb'=>$voteNb]);
    }

    /**
     * Test if the validation has been deleted from DB
     * @return void
     * @author 49222, 44424
     * @test
     */
    public function deleteValidation(){
        $validation = Validation::create([
            'voteNb' => 20,
            'userNb' => 69,
            'validationRate' => 80,
            'validated_at' => date('Y-m-d')
        ]);
        $id = $validation->id;
        $voteNb = $validation->voteNb;

        $this->assertDatabaseHas('validations', ['id'=>$validation->id, 'voteNb'=>$validation->voteNb]);
        $validation->delete();
        $this->assertDatabaseMissing('validations', ['id'=>$id, 'voteNb'=>$voteNb]);
    }
}
