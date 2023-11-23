<?php

namespace App\Livewire\Teams;

use App\Livewire\Attributes\Rules\UniquePlatformDomain;
use App\Models\Platform;
use App\Models\Team;
use App\Rules\UniqueSubdomain;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PlatformManager extends Component
{
    public Team $team;

    #[Validate()]
    public string $subdomain;

    public function mount(Team $team)
    {
        $this->team = $team;
        $this->subdomain = str($team->platforms->first()?->domain ?? '')->before('.'.config('app.main_domain'));
    }

    public function render()
    {
        return view('teams.platform-manager');
    }

    public function savePlatform()
    {
        $this->validate();
        $domain = str($this->subdomain)->finish('.'.config('app.main_domain'));
        $platform = Platform::firstOrNew([
            'team_id' => $this->team->id,
        ]);
        $platform->domain = $domain;
        $platform->save();
        $this->dispatch('saved');
    }

    public function rules()
    {
        return [
            'subdomain' => [
                'required',
                'string',
                'min:4',
                'max:75',
                'regex:/^([\w]+)$/',
                new UniqueSubdomain($this->team),
            ],
        ];
    }
}
