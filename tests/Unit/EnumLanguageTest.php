<?php

	namespace Tests\Unit;

	use App\Language;
	use Illuminate\Foundation\Testing\RefreshDatabase;
	use Illuminate\Support\Facades\App;
	use Tests\TestCase;

	class EnumLanguageTest extends TestCase {

		use RefreshDatabase;

		/**
		 * @test
		 * Test of the number of language in the application
		 *
		 * The test must be False
		 */
		public function TestSizeLanguage() {
			$this->assertNotEquals(1, count(Language::all()));
		}

		/**
		 * @test
		 * Check if the French language is in the enum
		 *
		 */
		public function TestFindLanguage() {
			$this->assertDatabaseHas('languages', [
				'slug' => 'FRA',
			]);
		}

		/**
		 * @test
		 * Check if there is 52 language in the enum
		 */
		public function TestNumberLanguage() {
			$temp = Language::all();
			$result = count($temp);
			$this->assertEquals($result, 59);
		}

		/**
		 * @test
		 */
		public function LanguageDescriptionTest() {
			$this->assertEquals('Dari', Language::where('slug', 'PRS')->get()->first()->content);
		}
	}
