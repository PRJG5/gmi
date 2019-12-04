<?php

	namespace Tests\Unit;

	use App\Phonetic;
	use Exception;
	use Illuminate\Foundation\Testing\RefreshDatabase;
	use Illuminate\Support\Facades\DB;
	use Tests\TestCase;

	class PhoneticTest extends TestCase {

		use RefreshDatabase;

		/**
		 * A basic unit test example.
		 *
		 * @return void
		 * @throws Exception
		 */
		public function testInsertDb() {
			$tempPho = new Phonetic();
			$str = 'coucou';
			$tempPho->text_description = $str;
			$tempPho->save();
			$verif = DB::table('phonetics')->where('text_description',
				$str)->select('*')->get();
			$this->assertEquals($verif[0]->text_description,
				$tempPho->text_description);
			$tempPho->delete();
		}

		/**
		 * A basic unit test example.
		 *
		 * @return void
		 * @throws Exception
		 */
		public function testInsertDbSpecialChar() {
			$tempPho = new Phonetic();
			$str = 'fdeəi:ɒaʊaɪʊəʤʧŋɜ:';
			$tempPho->text_description = $str;
			$tempPho->save();
			$verif = DB::table('phonetics')->where('text_description',
				$str)->select('*')->get();
			$this->assertEquals($verif[0]->text_description,
				$tempPho->text_description);
			$tempPho->delete();
		}

		public function testDeleteDb() {
			$tempPho = new Phonetic();
			$str = 'fdeəi:ɒaʊaɪʊəʤʧŋɜ:';
			$tempPho->text_description = $str;
			$tempPho->save();
			$verif = DB::table('phonetics')->where('text_description',
				$str)->select('*')->get();
			$this->assertEquals($verif[0]->text_description,
				$tempPho->text_description);
			$tempPho->delete();
			$this->assertDatabaseMissing('phonetics', [
					'text_description' => $str,
				]);
		}
	}
