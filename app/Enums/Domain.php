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
    const Juridique         = 0;
    const Sante_mentale     = 1;
    const Sante_somatique   = 2;
    const Technique         = 3;
    const Scientifique      = 4;
    const Economie          = 5;
    const Autre             = 6;
}
