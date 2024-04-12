<x-project-layout :project="$project">
    <div x-data="{ showAddRepository: true }">
        <header class="flex items-center justify-between">
            <h1 class="text-white text-xl font-bold">{{ $project->name }}</h1>
            @can('create-repository')
                <button type="button"
                    class="border border-violet-500 px-4 py-2 rounded-lg text-white font-medium uppercase flex items-center justify-between space-x-2"
                    x-on:click="showAddRepository = !showAddRepository;">
                    <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20.8218 10.1678H12.8306V2.17659C12.8306 1.82336 12.6902 1.4846 12.4405 1.23482C12.1907 0.985048 11.8519 0.844727 11.4987 0.844727C11.1455 0.844727 10.8067 0.985048 10.5569 1.23482C10.3072 1.4846 10.1668 1.82336 10.1668 2.17659V10.1678H2.17562C1.82238 10.1678 1.48362 10.3081 1.23385 10.5579C0.984072 10.8077 0.84375 11.1464 0.84375 11.4997C0.84375 11.8529 0.984072 12.1917 1.23385 12.4414C1.48362 12.6912 1.82238 12.8315 2.17562 12.8315H10.1668V20.8228C10.1668 21.176 10.3072 21.5148 10.5569 21.7645C10.8067 22.0143 11.1455 22.1546 11.4987 22.1546C11.8519 22.1546 12.1907 22.0143 12.4405 21.7645C12.6902 21.5148 12.8306 21.176 12.8306 20.8228V12.8315H20.8218C21.175 12.8315 21.5138 12.6912 21.7635 12.4414C22.0133 12.1917 22.1536 11.8529 22.1536 11.4997C22.1536 11.1464 22.0133 10.8077 21.7635 10.5579C21.5138 10.3081 21.175 10.1678 20.8218 10.1678Z"
                            fill="url(#paint0_linear_302_4131)" />
                        <defs>
                            <linearGradient id="paint0_linear_302_4131" x1="11.4987" y1="0.844727" x2="11.4987"
                                y2="22.1546" gradientUnits="userSpaceOnUse">
                                <stop stop-color="white" />
                                <stop offset="0.885" stop-color="#9A88F5" />
                            </linearGradient>
                        </defs>
                    </svg>

                    <span>Add repository</span>

                    <svg class="transition" width="18" height="9" viewBox="0 0 18 9" fill="none"
                        xmlns="http://www.w3.org/2000/svg" x-bind:class="{ 'rotate-180': showAddRepository }">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M0.857814 0.343831C1.35573 -0.11461 2.16302 -0.11461 2.66094 0.343831L8.98437 6.16592L15.3078 0.343832C15.8057 -0.114609 16.613 -0.114609 17.1109 0.343832C17.6089 0.802274 17.6089 1.54555 17.1109 2.004L9.88594 8.65617C9.64683 8.87632 9.32253 9 8.98437 9C8.64622 9 8.32192 8.87632 8.08281 8.65617L0.857814 2.00399C0.359895 1.54555 0.359895 0.802273 0.857814 0.343831Z"
                            fill="url(#paint0_linear_302_4133)" />
                        <defs>
                            <linearGradient id="paint0_linear_302_4133" x1="8.98438" y1="0" x2="8.98438"
                                y2="9" gradientUnits="userSpaceOnUse">
                                <stop stop-color="white" />
                                <stop offset="0.885" stop-color="#9A88F5" />
                            </linearGradient>
                        </defs>
                    </svg>
                </button>
            @endcan
        </header>
        @can('create-repository')
            <livewire:atlas.add-repository :project="$project" />
        @endcan
        <x-codex.repository-list :project="$project" />
        <x-codex.free-plan-banner class="mt-12" />
    </div>
</x-project-layout>
