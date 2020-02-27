<?php


namespace App\helpers;


class LanguageHelper
{
    const LANGUAGES = ["en", "fr", "am", "ru", "ar"];

    public static function checkLang($lang)
    {
        return in_array($lang, self::LANGUAGES);
    }
}
