<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 *
 */
final class Roles extends Enum implements LocalizedEnum
{
    const ADMIN = 0;
    const MOD = 1;
    const USERS = 2;
}
