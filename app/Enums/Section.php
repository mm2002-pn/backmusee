<?php

namespace App\Enums;

class Section
{
    
    const CAUTION = 1;
    const TRANSITE = 2;
    const EXPERT = 3;

    public static function getText($etape)
    {
        $map = [
            self::CAUTION => 'les cautions',
            self::TRANSITE => 'les transites',
            self::EXPERT => 'experts',
        ];

        return $map[$etape] ?? 'Inconnu';
    }
}
