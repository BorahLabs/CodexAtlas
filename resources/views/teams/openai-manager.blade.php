<div id="openai">
    <x-section-border />

    <div class="mt-10 sm:mt-0">
        <x-form-section submit="saveKey">
            <x-slot name="title">
                {{ __('Your OpenAI credentials') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Add your own OpenAI key to use CodexAtlas without limitations. We know it sounds scary, so as a reference we can say that documenting a project with 500 files costs ~1.50€. Also, your keys are securely stored and encrypted.') }}
            </x-slot>

            <x-slot name="form">
                <!-- OpenAI Key -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="key" value="{{ __('OpenAI Key') }}" />
                    @if ($isEditing)
                        <x-input id="key" type="text" class="mt-1 block w-full border-r-0" wire:model="key"
                            placeholder="sk-**********" />
                    @else
                        <div
                            class="border-gray-700 bg-slate-700 text-gray-300 rounded-md shadow-sm mt-1 w-full border-r-0 flex">
                            <span
                                class="block p-2">{{ preg_replace('/(\*{3,})/', ' · · · · · ', Str::mask(auth()->user()->currentTeam->openai_key, '*', 3, -4)) }}</span>
                            <button type="button" wire:click="$set('isEditing', true)"
                                class="text-gray-400 ml-auto hover:text-gray-300 px-2">
                                <x-codex.icons.pencil class="h-5 w-5" />
                            </button>
                        </div>
                    @endif
                    <span class="block mt-2 text-slate-200 text-sm">You can create a new key <a
                            href="https://platform.openai.com/api-keys" class="underline" target="_blank">in the OpenAI
                            Platform</a></span>
                    <x-input-error for="key" class="mt-2" />
                </div>

            </x-slot>

            <x-slot name="actions">
                <x-action-message class="me-3" on="saved">
                    {{ __('Your key was successfully updated.') }}
                </x-action-message>

                @if ($isEditing)
                    <x-button type="button" wire:click="$set('isEditing', false)" class="mr-4">
                        {{ __('Cancel') }}
                    </x-button>
                @endif
                <x-button :disabled="!$isEditing">
                    {{ __('Update') }}
                </x-button>
            </x-slot>
        </x-form-section>
    </div>
</div>
