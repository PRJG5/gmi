<?php

use App\Enums\Roles;

/**
 * Returns the string value of the enum
 */
return [
    Roles::class=> [
        Roles::ADMIN => 'Administrateur',
        Roles::MOD => 'Modérateur',
        Roles::USERS => 'Utilisateur',
    ],
];
