<?php

namespace App\Enums;

enum FileChange: string
{
    case Added = 'added';
    case Modified = 'modified';
    case Removed = 'removed';
}
