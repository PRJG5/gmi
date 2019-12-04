<?php

	namespace Tests\Unit;

	use App\Subdomain;
	use Illuminate\Foundation\Testing\RefreshDatabase;
	use Illuminate\Support\Facades\App;
	use Tests\TestCase;

	class EnumSubdomainTest extends TestCase {

		use RefreshDatabase;

		/**
		 * This test is checking if all the values of the enumeration are returned
		 * True when length is 7
		 */
		public function getValue() {
			$length = count(Subdomain::getValues());
			$this->assertTrue($length == 24);
		}

		/**
		 * This test tests the getter of the enumeration with a number
		 */
		public function testGetKEYOne() {
			$this->assertDatabaseHas('subdomains', [
				'content' => 'Justice',
			]);
		}

		public function testGetDescription() {
			$this->assertDatabaseHas('subdomains', [
				'content' => 'Asylum',
			]);
		}
	}
