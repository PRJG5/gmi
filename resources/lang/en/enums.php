<?php

use App\Enums\Roles;

return [
    Roles::class=> [
        Roles::ADMIN => 'Administrator',
        Roles::MOD => 'Moderator',
        Roles::USERS => 'User',
    ],
 ];
