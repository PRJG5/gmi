<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;


/**
 * enumeration of the sub domains 
 */
final class Subdomain extends Enum implements LocalizedEnum
{
	const Anesthesia				= 'Anesthesia';
	const Asylum					= 'Asylum';
	const Cardiology				= 'Cardiology';
	const Dentistry					= 'Dentistry';
	const Dermatology				= 'Dermatology';
	const Diabetology				= 'Diabetology';
	const Endocrinology				= 'Endocrinology';
	const Gastroenterology			= 'Gastroenterology';
	const Geriatric					= 'Geriatric';
	const Gynecology				= 'Gynecology';
	const Justice					= 'Justice';
	const Nephrology				= 'Nephrology';
	const Neurology					= 'Neurology';
	const Oncology					= 'Oncology';
	const Otorhinolaryngology		= 'Otorhinolaryngology';
	const OrthopedicTraumatology	= 'Orthopedic Traumatology';
	const Pediatric					= 'Pediatric';
	const Physiotherapy				= 'Physiotherapy';
	const Pneumonology				= 'Pneumonology';
	const Police					= 'Police';
	const Radiology					= 'Radiology';
	const Surgery					= 'Surgery';
	const Urology					= 'Urology';
	const Other						= 'Other';

}
