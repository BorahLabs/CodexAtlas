<div>
    <div class="grid grid-cols-1 max-w-xs mx-auto mb-12">
        <div>
            <label for="language" class="block text-darkBlue-100 text-sm font-medium mb-2">
                I want to document
            </label>
            <select id="language" wire:model.live="language" class="px-4 py-2 rounded-md bg-black text-white w-full">
                <option value="">Select option</option>
                @foreach ($this->languages as $lang)
                    <option value="{{ $lang->name() }}">{{ $lang->name() }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @if ($language)
        <div class="text-white">
            <livewire:tools.code-documentation :language="$language" :fromPlatform="true" :key="'code-documentation-' . $language" />
        </div>
    @endif
</div>
