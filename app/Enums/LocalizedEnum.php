<?php
namespace App\Enums;

interface LocalizedEnum
{
    /**
     * Get the default localization key.
     *
     * @return string
     */
    public static function getLocalizationKey();
    
}