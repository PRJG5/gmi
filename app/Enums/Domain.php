<?php

	namespace App\Enums;

	use BenSampo\Enum\Contracts\LocalizedEnum;
	use BenSampo\Enum\Enum;

	/**
	 * The values for the domain of the application
	 */
	final class Domain extends Enum implements LocalizedEnum {
		const Economic = 'Economic';
		const Legal = 'Legal';
		const MentalHealth = 'Mental Health';
		const Scientific = 'Scientific';
		const SomaticHealth = 'Somatic Health';
		const Technical = 'Technical';
		const Other = 'Other';
	}
