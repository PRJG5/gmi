<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;


/**
 * enumeration of the sub domains 
 */
final class Subdomain extends Enum implements LocalizedEnum
{
    const Asylum            = 'Asylum';
    const Justice           = 'Justice';
    const Police            = 'Police';
    const Anesthesia        = 'Anesthesia';
    const Cardiology        = 'Cardiology';
    const Surgery           = 'Surgery';
    const Dentistry         = 'Dentistry';
    const Dermatology       = 'Dermatology';
    const Diabetology       = 'Diabetology';
    const Endocrinology     = 'Endocrinology';
    const Gastro_enterology = 'Gastro_enterology';
    const Gériatric         = 'Gériatric';
    const Gynecology        = 'Gynecology';
    const Physiotherapy     = 'Physiotherapy';
    const Nephrology        = 'Nephrology';
    const Neurology         = 'Neurology';
    const Oncology          = 'Oncology';
    const ORL               = 'ORL';
    const Orthopédic_Traumatology = 'Orthopédic_Traumatology';
    const Pédiatric         = 'Pédiatric';
    const Pneumonology       = 'Pneumonology';
    const Radiology         = 'Radiology';
    const Urology           = 'Urology';
    const Other             = 'Other';

}
