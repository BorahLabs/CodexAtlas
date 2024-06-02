<div>
    <div class="grid grid-cols-1 gap-8 md:grid-cols-2 max-w-md mx-auto mb-12">
        <div>
            <label for="from-lang" class="block text-darkBlue-100 text-sm font-medium mb-2">
                I want to convert from
            </label>
            <select id="from-lang" wire:model.live="from" class="px-4 py-2 rounded-md bg-black text-white w-full">
                <option value="">Select option</option>
                @foreach ($this->froms as $langFrom)
                    <option value="{{ Str::slug($langFrom->name()) }}">{{ $langFrom->name() }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="to-lang" class="block text-darkBlue-100 text-sm font-medium mb-2">
                to
            </label>
            <select id="to-lang" wire:model.live="to" class="px-4 py-2 rounded-md bg-black text-white w-full">
                <option value="">Select option</option>
                @foreach ($this->tos as $langTo)
                    <option value="{{ Str::slug($langTo->name()) }}">{{ $langTo->name() }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @if ($from && $to)
        <livewire:tools.code-converter :from="$from" :to="$to" :fromPlatform="true" :key="'code-converter-' . $from . '-' . $to" />
    @endif
</div>
