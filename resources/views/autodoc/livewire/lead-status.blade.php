<div wire:poll.5s>
    <h1>Thank you!</h1>
    @if ($finished)
        <p>Your documentation has been generated. You will receive an email with the documentation in Markdown
            format.</p>
    @else
        <p>Your documentation is now being generated. You will receive an email with the documentation in
            Markdown
            format when it finishes. You can close this screen if you want.</p>
    @endif

    <div>
        <h2 class="mb-0 text-4xl mt-0">{{ $processed }} / {{ $total }}</h2>
        <p>successfully documented files</p>
    </div>

    @if ($finished)
        <x-filament::button type="button" wire:click="downloadDocs">Download documentation</x-filament::button>
    @endif

    <table class="text-xs">
        <thead>
            <tr>
                <th class="text-left">File</th>
                <th class="text-left">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($systemComponents as $path => $status)
                <tr>
                    <td>
                        @if (mb_strlen($path) > 30)
                            <span
                                title="{{ $path }}">{{ str($path)->limit(10) }}{{ str($path)->substr(-20) }}</span>
                        @else
                            {{ $path }}
                        @endif
                    </td>
                    <td>
                        <div @class([
                            'flex items-center space-x-2',
                            'text-gray-600' => $status === \App\Enums\SystemComponentStatus::Pending,
                            'text-red-600' => $status === \App\Enums\SystemComponentStatus::Error,
                            'text-amber-600' =>
                                $status === \App\Enums\SystemComponentStatus::Generating,
                            'text-green-600' => $status === \App\Enums\SystemComponentStatus::Generated,
                        ])>
                            @switch($status)
                                @case(\App\Enums\SystemComponentStatus::Pending)
                                    <svg class="h-4 w-4" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                                    </svg>
                                @break

                                @case(\App\Enums\SystemComponentStatus::Error)
                                    <svg class="h-4 w-4" fill="none" stroke-width="2" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z">
                                        </path>
                                    </svg>
                                @break

                                @case(\App\Enums\SystemComponentStatus::Generating)
                                    <svg class="h-4 w-4" fill="none" stroke-width="2" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25Zm.75-12h9v9h-9v-9Z">
                                        </path>
                                    </svg>
                                @break

                                @case(\App\Enums\SystemComponentStatus::Generated)
                                    <svg class="h-4 w-4" fill="none" stroke-width="2" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                                    </svg>
                                @break
                            @endswitch
                            <span>{{ $status->name }}</span>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
