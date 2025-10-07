<?php

namespace App\Enums;

class Etape
{
    const SOUMISSION = 1;
    const SUIVI_MARCHE = 2;

    public static function getText($etape)
    {
        $map = [
            self::SOUMISSION => 'A la soumission',
            self::SUIVI_MARCHE => 'Suivi marché',
        ];

        return $map[$etape] ?? 'Inconnu';
    }
}
