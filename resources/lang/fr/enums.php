<?php

use App\Enums\Language;
Use App\Enums\Domain;
Use App\Enums\Subdomain;
//ressources/lang/fr/EnumLanguage.php

return [
    Language::class =>[
        Language::ALB => 'Albanais',
        Language::DEU => 'Allemand',
        Language::EN => 'Anglais',
        Language::ARA => 'Arabe',
        Language::ARC => 'Araméen',
        Language::HYE => 'Arménien',
        Language::BAD => 'Badini',
        Language::BAM => 'Bambara',
        Language::BER => 'Berbère',
        Language::BOS => 'Bosniaque',
        Language::BUL => 'Bulgare',
        Language::ZHO => 'Chinois',
        Language::KOR => 'Coréen',
        Language::HRV => 'Croate',
        Language::PRS => 'Dari',
        Language::SPA => 'Espagnol',
        Language::FAS => 'Farsi',
        Language::FRA => 'Français',
        Language::KAT => 'Géorgien',
        Language::GRC => 'Grec',
        Language::GUJ => 'Gujarati',
        Language::HIN => 'Hindi',
        Language::KAZ => 'Kazakh',
        Language::ITA => 'Italien',
        Language::JPN => 'Japonais',
        Language::KUR => 'Kurde',
        Language::LIN => 'Lingala',
        Language::MKD => 'Macédonien',
        Language::MAN => 'Malinké',
        Language::MOL => 'Moldave',
        Language::CNR => 'Monténégrin',
        Language::NLD => 'Néerlandais',
        Language::UIG => 'Ouïgour',
        Language::URD => 'Ourdou',
        Language::PUS => 'Pashto',
        Language::POL => 'Polonais',
        Language::FUL => 'Poular',
        Language::POR => 'Portugais',
        Language::PAN => 'Pundjabi',
        Language::ROM => 'Rom',
        Language::RON => 'Roumain',
        Language::RUS => 'Russe',
        Language::HBS => 'Serbe',
        Language::SLK => 'Slovaque',
        Language::SLV => 'Slovène',
        Language::SOM => 'Somali',
        Language::CKB => 'Sorani',
        Language::SUS => 'Soussou',
        Language::SWA => 'Swahili',
        Language::RIF => 'Tarifit',
        Language::CHE => 'Tchétchène',
        Language::CES => 'Tchèque',
        Language::TIR => 'Tigrigna',
        Language::TUR => 'Turc',
        Language::TUK => 'Turkmène',
        Language::UKR => 'Ukrainien',
        Language::LSBF => 'Langue des signes de belgique francophone',
        Language::LSBN => 'Langue des signes de belgique néerlandophone',
        Language::SSI => 'Système des signes international',
        ],
    ];

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
