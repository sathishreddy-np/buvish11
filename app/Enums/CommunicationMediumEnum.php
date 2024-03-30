<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum CommunicationMediumEnum: string implements HasLabel
{
    case Email = 'email';
    case SMS = 'sms';
    case WhatsApp = 'whatsapp';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Email => 'Email',
            self::SMS => 'SMS',
            self::WhatsApp => 'WhatsApp',
        };
    }
}
