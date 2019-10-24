<?php

Use App\Enums\Domain;
Use App\Enums\Subdomain;
/**
 * Returns the string value of the enum
 */
return [

    Domain::class=> [
        Domain::Juridique         => 'Juridique',
        Domain::Sante_mentale     => 'Sante mentale',
        Domain::Sante_somatique   => 'Sante somatique',
        Domain::Technique         => 'Technique',
        Domain::Scientifique      => 'Scientifique',
        Domain::Economie          => 'Economie',
        Domain::Autre             => 'Autre',
    ],

    Subdomain::class=> [
        Subdomain::Asile             => 'Asile',
        Subdomain::Justice           => 'Justice',
        Subdomain::Policier          => 'Policier',
        Subdomain::Anesthésie        => 'Anesthésie',
        Subdomain::Cardiologie       => 'Cardiologie',
        Subdomain::Chirurgie         => 'Chirurgie',
        Subdomain::Dentisterie       => 'Dentisterie',
        Subdomain::Dermatologie      => 'Dermatologie',
        Subdomain::Diabétologie      => 'Diabétologie',
        Subdomain::Endocrinologie    => 'Endocrinologie',
        Subdomain::Gastro_entérologie => 'Gastro entérologie',
        Subdomain::Gériatrie         => 'Gériatrie',
        Subdomain::Gynécologie       => 'Gynécologie',
        Subdomain::Kinésithérapie    => 'Kinésithérapie',
        Subdomain::Néphrologie       => 'Néphrologie ',
        Subdomain::Neurologie        => 'Neurologie',
        Subdomain::Oncologie         => 'Oncologie',
        Subdomain::ORL               => 'ORL',
        Subdomain::Orthopédie_Traumatologie => 'Orthopédie Traumatologie',
        Subdomain::Pédiatrie         => 'Pédiatrie',
        Subdomain::Pneumologie       => 'Pneumologie',
        Subdomain::Radiologie        => 'Radiologie',
        Subdomain::Urologie          => 'Urologie',
        Subdomain::Autre             => 'Autre',
    ]
]


?>