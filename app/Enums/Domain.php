<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Rules\EnumValue;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * The values for the domain of the application 
 */

final class Domain extends Enum implements LocalizedEnum
{
    const Economic          = 'Economic';
    const Legal         	= 'Legal';
    const Mental_health     = 'Mental Health';
    const Scientific        = 'Scientific';
    const Somatic_health    = 'Somatic Health';
    const Technical         = 'Technical';
    const Other             = 'Other';
}
