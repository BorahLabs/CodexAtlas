<?php

namespace App\Enums;

use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum SoRequirementType: string implements HasIcon, HasLabel
{
    case MAC = 'mac';
    case WINDOWS = 'windows';
    case LINUX = 'linux';

    public function getIcon(): string
    {
        return match ($this) {
            self::MAC => 'icon-apple',
            self::WINDOWS => 'icon-windows',
            self::LINUX => 'icon-linux',
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::MAC => 'Mac',
            self::WINDOWS => 'Windows',
            self::LINUX => 'Linux',
        };
    }
}
