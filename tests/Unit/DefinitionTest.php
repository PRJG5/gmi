<?php

	namespace Tests\Unit;

	use App\Definition as Definition;
	use Illuminate\Foundation\Testing\RefreshDatabase;
	use Tests\TestCase;

	class DefinitionTest extends TestCase {

		use RefreshDatabase;

		/**
		 * @Test
		 * Checks if the definition create has the correct content
		 */
		public function testDefinitionWithContent() {
			$definition_content = 'hello33';
			$definition = new Definition([
				'definition_content' => $definition_content,
			]);
			$definition->save();

			$this->assertDatabaseHas('definitions', [
					'definition_content' => $definition_content,
				]);
		}

		/**
		 * @Test
		 * checks if the ID of the definition is properly set automatically
		 */
		public function testDefinitionWithId() {
			$definition_content = 'hello33';
			$definition = new Definition([
				'definition_content' => $definition_content,
			]);
			$definition->save();

			$this->assertDatabaseHas('definitions', [
					'id'                 => $definition->id,
					'definition_content' => $definition_content,
				]);
		}

		/**
		 * @Test
		 * Checks if it deletes the definition in the database
		 */
		public function testDefinitionMissing() {
			$definition_content = 'hello33';
			$definition = new Definition([
				'definition_content' => $definition_content,
			]);
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
			$definition_content = 'Test to string';
			$definition = new Definition([
				'definition_content' => $definition_content,
			]);
			$definition->save();

			$str = $definition->__toString();
			$this->assertTrue($str == $definition->id . ' - ' . $definition_content);
		}
	}
