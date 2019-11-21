<?php

namespace Tests\Unit;

use Tests\TestCase;

use App\Definition as Definition;

class DefinitionTest extends TestCase
{
    /**
     * @Test
     * Checks if the definition create has the correct content
     */
    public function testDefinitionWithContent()
    {
        $definition = new Definition();
        $definition->definition_content = "hello33";
        $definition->save();
        $this->assertDatabaseHas('definitions', [
            'definition_content' => $definition->definition_content,
        ]);
        $definition->delete();
    }

    /**
     * @Test
     * checks if the ID of the definition is properly set automatically
     */
    public function testDefinitionWithId() {
        $definition = new Definition();
        $definition->definition_content = "hello33";
        $definition->save();
        $this->assertDatabaseHas('definitions', [
            'id' => $definition->id,
            'definition_content' => $definition->definition_content,
        ]);
        $definition->delete();
    }

    /**
     * @Test
     * Checks if it deletes the definition in the database
     */
    public function testDefinitionMissing() {
        $definition = new Definition();
        $definition->definition_content = "hello33";
        $definition->save();
        $definition->delete();
        $this->assertDatabaseMissing('definitions', [
            'id' => $definition->id,
        ]);
    }

    /**
     * @Test
     * Checks if the to string method works properly
     */
    public function testDefinitionToString() {
        $definition = new Definition();
        $definition->definition_content = "Test to string";
        $definition->save();
        $str = $definition->__toString();
        $this->assertTrue($str == $definition->id . " - " . "Test to string");
        $definition->delete();
    }
}
