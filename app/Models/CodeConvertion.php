<?php

namespace App\Models;

use App\Models\Traits\HasUserFeedback;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeConvertion extends Model
{
    use HasFactory;
    use HasUserFeedback;
}
