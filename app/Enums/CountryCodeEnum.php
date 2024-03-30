<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum CountryCodeEnum: string implements HasLabel
{
    case India = '+91';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::India => '+91 | India',
        };
    }
}
