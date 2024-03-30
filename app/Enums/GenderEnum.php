<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum GenderEnum: string implements HasLabel
{
    case Male = 'male';
    case Female = 'female';
    case Kid = 'kid';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Male => 'Male',
            self::Female => 'Female',
            self::Kid => 'Kid',
        };
    }
}
