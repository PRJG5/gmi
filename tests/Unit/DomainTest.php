<?php

	namespace Tests\Unit;

	use App\Domain;
	use Illuminate\Foundation\Testing\RefreshDatabase;
	use Tests\TestCase;

	class DomainTest extends TestCase {

		use RefreshDatabase;

		/**
		 * Check if the domain is in the database.
		 */
		public function testDomainInsert() {
			$domain = new Domain();
			$domain->content = 'Test Domain';
			$domain->save();
			$this->assertDatabaseHas('domains', [
				'content' => $domain->content,
			]);
			$domain->delete();
		}

		public function testDomainDelete() {
			$domain = new Domain();
			$domain->content = 'Test Domain';
			$domain->save();
			$idDomain = $domain->id;
			$domain->delete();
			$this->assertDatabaseMissing('domains', [
				'id' => $idDomain,
			]);
		}

	}
