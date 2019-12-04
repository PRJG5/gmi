<?php

	namespace App\Imports;

	use App\Language;
	use Illuminate\Database\Eloquent\Model;
	use Maatwebsite\Excel\Concerns\ToModel;

	/**
	 * This class allows to import languages with a excel
	 */
	class LanguagesImport implements ToModel {
		/**
		 * @param array $row
		 *
		 * @return Model|null
		 */
		public function model(array $row) {
			if(!empty($row[0] && !empty($row[1]))) {
				return new Language([
					'content' => $row[0],
					'slug'    => $row[1],
				]);
			}

		}
	}
