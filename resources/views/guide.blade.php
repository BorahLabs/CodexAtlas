<x-web-layout>
    @section('title', $currentFile->name() . ' | CodexAtlas')
    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 grid grid-cols-1 gap-12 sm:grid-cols-3 md:grid-cols-4 text-white">
            <aside class="col-span-1 space-y-4" x-data="{ folder: '{{ $currentFolder['children']->first()->folderId() }}' }">
                @foreach ($folders as $f)
                    @php
                        $open = $f === $currentFolder;
                    @endphp
                    <div>
                        <button type="button" x-on:click="folder = '{{ $f['children']->first()->folderId() }}'"
                            class="font-bold text-base">{{ $f['name'] }}</button>
                        <ul x-show="folder === '{{ $f['children']->first()->folderId() }}'" {{ $open ? '' : 'x-cloak' }}
                            x-transition class="pl-2 mt-2 text-sm">
                            @foreach ($f['children'] as $file)
                                <li>
                                    @if ($file->isComingSoon())
                                        <div class="p-2 flex justify-between items-center relative">
                                            <span>{{ $file->name() }}</span>
                                            <span
                                                class="text-[0.575rem] leading-none font-semibold uppercase px-1.5 py-0.5 rounded-full bg-violet-600 text-white">{{ __('Soon') }}</span>
                                        </div>
                                    @else
                                        <a href="{{ $file->url() }}" class="p-2 block relative">
                                            @if ($file->url() === request()->url())
                                                <div
                                                    class="h-2 w-2 absolute -left-3 top-1/2 -translate-y-1/2 bg-blue-100 rounded-full">
                                                </div>
                                            @endif
                                            <span>{{ $file->name() }}</span>
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </aside>
            <div class="col-span-1 sm:col-span-2 md:col-span-3">
                @if ($currentFile->isComingSoon())
                    <div class="prose prose-invert" id="guide-content">
                        <h1>Coming soon</h1>
                        <p>Oops! We are still working on this functionality, but you should be able to enjoy it quite
                            soon!</p>
                        <p>Get in touch with <a href="mailto:raul@borah.agency">our CTO</a> if you want to learn
                            more.
                        </p>
                    </div>
                @else
                    <div class="prose prose-invert" id="guide-content">
                        {!! Str::markdown($currentFile->contents) !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-web-layout>
