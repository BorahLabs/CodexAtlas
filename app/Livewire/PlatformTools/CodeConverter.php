<?php

namespace App\Livewire\PlatformTools;

use App\CodeConverter\Tools\CodeConverterTool;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Component;

class CodeConverter extends Component
{
    public ?string $from = null;

    public ?string $to = null;

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('livewire.platform-tools.code-converter');
    }

    public function updatedFrom(): void
    {
        $this->to = null;
    }

    #[Computed]
    public function froms(): Collection
    {
        return collect(CodeConverterTool::all())
            ->mapWithKeys(fn (CodeConverterTool $tool) => [$tool->from->name() => $tool->from])
            ->values();
    }

    #[Computed]
    public function tos(): Collection
    {
        if (is_null($this->from)) {
            return collect([]);
        }

        return collect(CodeConverterTool::all())
            ->filter(fn (CodeConverterTool $tool) => Str::slug($tool->from->name()) === $this->from)
            ->mapWithKeys(fn (CodeConverterTool $tool) => [$tool->to->name() => $tool->to])
            ->values();
    }
}
