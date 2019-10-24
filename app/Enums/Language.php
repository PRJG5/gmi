<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Language extends Enum
{
    const ARC =0;
    const HYE =1;
    const BAM =2;
    const BER =3;
    const BOS =4;
    const BUL =5;
    const ZHO =6;
    const KOR =7;
    const HRV =8;
    const PRS =9;
    const SPA =10;
    const FAS =11;
    const FRA =12;
    const KAT =13;
    const GRC =14;
    const GUJ =15;
    const HIN =16;
    const KAZ =17;
    const IT =18;
    const JPN =19;
    const KUR =20;
    const LIN =21;
    const MKD =22;
    const MAN =23;
    const MOL =24;
    const CNR =25;
    const NLD =26;
    const UIG =27;
    const URD =28;
    const PUS =29; 
    const POL =30;
    const FUL =31;
    const POR =32;
    const PAN =33;
    const ROM =34;
    const RON =35;
    const RUS =36;
    const HBS =37;
    const SLK =38;
    const SLV =39;
    const SOM =40;
    const CKB =41;
    const SUS =42;
    const SWA =43;
    const RIF =44;
    const CHE =45;
    const CES =46;
    const TIR =47;
    const TUR =48;
    const TUK =49;
    const UKR =50;


    public static function getDescription($values):String{
        switch($values){
            case self::ARA : return "Arabe";
        }
        return parent::getDescription($value);
    }
}
