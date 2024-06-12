<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-8 lg:flex-row">
                <aside class="flex-shrink-0">
                    <nav>
                        <ul class="divide-y divide-[#504A8A]">
                            <li class="py-2">
                                <x-codex.projects.nav-link :to="route('app.tools.code-conversion')" text="Code conversion" icon="list" />
                            </li>
                            <li class="py-2">
                                <x-codex.projects.nav-link :to="route('app.tools.document-files')" text="Document files" icon="list" />
                            </li>
                            <li class="py-2">
                                <x-codex.projects.nav-link :to="route('app.tools.fix-my-code')" text="Fix my code" icon="list" />
                            </li>
                            <li class="py-2">
                                <x-codex.projects.nav-link :to="route('app.tools.readme-generator')" text="README Generator" icon="list" />
                            </li>
                        </ul>
                    </nav>
                </aside>
                <div class="w-full lg:min-w-[500px] flex-1">
                    {{ $slot }}
                </div>
            </div>
        </div>
</x-app-layout>
