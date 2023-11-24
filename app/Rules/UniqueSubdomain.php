<?php

namespace App\Rules;

use App\Models\Platform;
use App\Models\Team;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueSubdomain implements ValidationRule
{
    public function __construct(
        public Team $team,
    ) {
        //
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $domain = str($value)->finish('.'.config('app.main_domain'))->toString();
        $exists = Platform::where('team_id', '!=', $this->team->id)
            ->where('domain', $domain)
            ->exists();
        if ($exists) {
            $fail(__('Domain already exists'));
        }
    }
}
