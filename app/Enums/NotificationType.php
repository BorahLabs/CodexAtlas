<?php

namespace App\Enums;

enum NotificationType
{
    case DemoCall;
    case Success;
    case Error;
    case Warning;
    case Info;

    public function icon(): string
    {
        return match ($this) {
            self::DemoCall => ':telephone_receiver:',
            self::Success => ':white_check_mark:',
            self::Error => ':x:',
            self::Warning => ':warning:',
            self::Info => ':information_source:',
        };
    }
}
