<?php

namespace App\Enums;

enum SystemComponentStatus: string {
    case Pending = 'pending';
    case Generating = 'generating';
    case Error = 'error';
    case Regenerating = 'regenerating';
}
