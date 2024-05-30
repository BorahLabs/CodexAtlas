<?php

namespace App\Livewire\PlatformTools;

use App\CodeConverter\Tools\CodeConverterTool;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Component;

class CodeConverter extends Component
{
    public ?string $from = null;
    public ?string $to = null;

    public function render()
    {
        return view('livewire.platform-tools.code-converter');
    }

    public function updatedFrom()
    {
        $this->to = null;
    }

    #[Computed]
    public function froms()
    {
        return collect(CodeConverterTool::all())
            ->mapWithKeys(fn (CodeConverterTool $tool) => [$tool->from->name() => $tool->from])
            ->values();
    }

    #[Computed]
    public function tos()
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
