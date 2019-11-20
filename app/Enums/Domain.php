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
    const Juridical         = 'Juridical';
    const Mental_health     = 'Mental_health';
    const Somatic_health    = 'Somatic_health';
    const Technical         = 'Technical';
    const Scientific        = 'Scientific';
    const Economic          = 'Economic';
    const Other             = 'Other';
}
