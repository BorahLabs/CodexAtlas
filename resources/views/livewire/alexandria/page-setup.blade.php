<div>
    <div class="prose">
        @if ($this->isEditing)
            <h1>Edit guide</h1>
        @else
            <h1>Create a new guide</h1>
        @endif
        <p>Guides are a great way to share knowledge with others. Even though AI is great, great documentation still
            needs a human touch.</p>
        <p>You can write a title and the guide on your own, or you can ask a question and let the AI write the guide for
            you.</p>
    </div>

    <label for="question_driven" class="flex items-center mt-4 mb-8" style="light">
        <x-checkbox wire:model.live="questionDriven" id="question_driven" name="question_driven" checked />
        <span class="ms-2 text-sm ">💡 {{ __('Let the AI generate the guide from a question') }}</span>
    </label>
    @if ($questionDriven)
        <form wire:submit="submitQuestion" class="flex items-end">
            <div class="w-full">
                <x-label for="question" value="{{ __('What is your question?') }}" style="light" />
                <x-input id="question" class="block mt-1 w-full" autofocus type="text" name="question"
                    wire:model="question" required style="light" />
            </div>
            <x-secondary-button class="ml-4 h-[2.675rem]" type="submit" style="light">
                {{ __('Generate') }}
            </x-secondary-button>
        </form>
    @endif
    <div class="mt-12">
        <form wire:submit="submit">
            <x-label for="title" value="{{ __('Guide title') }}" style="light" />
            <x-input id="title" class="block mt-1 w-full" type="text" name="title" wire:model="title" required
                style="light" />
            <x-label for="content" value="{{ __('Guide content') }}" style="light" class="mt-4" />
            <x-textarea id="content" class="block mt-1 w-full" type="text" name="content" rows="10"
                wire:model="content" required style="light" />
            <div class="flex justify-end mt-8">
                <x-secondary-button type="submit" style="light">
                    {{ __('Save guide') }}
                </x-secondary-button>
            </div>
        </form>
    </div>
</div>
