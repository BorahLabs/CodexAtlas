<x-filament::modal width="xl">
    <x-slot name="trigger">
        <button type="button" class="fixed bottom-4 right-4 h-12 w-12 rounded-full bg-primary-500 flex items-center justify-center transition hover:bg-primary-400">
            <x-heroicon-o-chat-bubble-oval-left-ellipsis class="w-6 h-6 text-white" />
        </button>
    </x-slot>

    <div class="flex justify-end">
        <x-filament::button wire:click="resetMessages" icon="heroicon-o-trash" color="gray" size="xs">
            Reset chat
        </x-filament::button>
    </div>
    <div class="prose">
        <h4>Do you need help?</h4>
        <p>
            You can talk to our AI assistant. It has all the information needed to help you with your problem :)
        </p>
    </div>
    <div class="flex flex-col w-full min-h-64 max-h-[calc(100vh_-_400px)] overflow-y-auto bg-gray-50 rounded-lg gap-2 p-4">
        @forelse ($messages as $message)
            @if ($message['role'] !== 'system')
            <div @class([
                'prose prose-sm p-4 rounded-xl max-w-[80%]',
                'bg-primary-100 self-end text-primary-900' => $message['role'] === 'user',
                'bg-gray-200 text-gray-900' => $message['role'] === 'assistant',
            ])>
                {!! Str::markdown($message['content']) !!}
            </div>
            @endif
        @empty
            <div class="p-4 prose prose-sm flex items-center justify-center h-full">
                Your messages will appear here
            </div>
        @endforelse

        <div class="prose prose-sm p-4 rounded-xl max-w-[80%] bg-primary-100 self-end text-primary-900" wire:loading wire:target="submit" wire:stream="newMessageUser"></div>
        <div class="prose prose-sm p-4 rounded-xl max-w-[80%] bg-gray-200 text-gray-900" wire:loading wire:target="submit" wire:stream="newMessageAssistant"></div>
    </div>
    <form wire:submit="submit">
        {{ $this->form }}
        <div class="flex justify-end mt-4">
            <x-filament::button type="submit" icon="heroicon-o-paper-airplane">
                Send
            </x-filament::button>
        </div>
    </form>
</x-filament::modal>
