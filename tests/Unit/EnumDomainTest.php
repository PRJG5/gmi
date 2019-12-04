<?php

	namespace Tests\Unit;

	use App\Domain as Domain;
	use Illuminate\Foundation\Testing\RefreshDatabase;
	use Illuminate\Support\Facades\App;
	use Tests\TestCase;

	class EnumDomainTest extends TestCase {

		use RefreshDatabase;

		/**
		 * @test
		 * This test is checking if all domains are returned
		 * True when length is 7
		 */
		public function checkAllDomains() {
			$length = count(Domain::all());
			$this->assertEquals($length, 7);
		}

	}
