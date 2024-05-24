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
        return match($this) {
            static::DemoCall => ':telephone_receiver:',
            static::Success => ':white_check_mark:',
            static::Error => ':x:',
            static::Warning => ':warning:',
            static::Info => ':information_source:',
        };
    }
}
