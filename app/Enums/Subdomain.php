<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;


/**
 * enumeration of the sub domains 
 */
final class Subdomain extends Enum implements LocalizedEnum
{
    const Asile             = 0;
    const Justice           = 1;
    const Policier          = 2;
    const Anesthésie        = 3;
    const Cardiologie       = 4;
    const Chirurgie         = 5;
    const Dentisterie       = 6;
    const Dermatologie      = 7;
    const Diabétologie      = 8;
    const Endocrinologie    = 9;
    const Gastro_entérologie = 10;
    const Gériatrie         = 11;
    const Gynécologie       = 12;
    const Kinésithérapie    = 13;
    const Néphrologie       = 14;
    const Neurologie        = 15;
    const Oncologie         = 16;
    const ORL               = 17;
    const Orthopédie_Traumatologie = 18;
    const Pédiatrie         = 19;
    const Pneumologie       = 20;
    const Radiologie        = 21;
    const Urologie          = 22;
    const Autre             = 23;

}
