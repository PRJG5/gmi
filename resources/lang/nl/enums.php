<?php

use App\Enums\Roles;

/**
 * Returns the string value of the enum
 */
return [
    Roles::class=> [
        Roles::ADMIN => 'Administrateur',
        Roles::MOD => 'Moderator',
        Roles::USERS => 'Gebruiker',
    ],
];
