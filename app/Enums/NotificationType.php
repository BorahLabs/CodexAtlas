<?php

namespace App\Enums;

enum NotificationType
{
    case Success;
    case Error;
    case Warning;
    case Info;

    public function icon(): string
    {
        return match($this) {
            static::Success => ':white_check_mark:',
            static::Error => ':x:',
            static::Warning => ':warning:',
            static::Info => ':information_source:',
        };
    }
}
