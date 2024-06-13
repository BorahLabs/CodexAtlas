<x-project-layout :project="$project">
    <div x-data="{ showBlur: false }" @open.window="showBlur=true" @close.window="showBlur=false">
        <div x-cloak x-show="showBlur" class="fixed top-0 left-0 w-screen h-screen z-10 bg-dark bg-opacity-80"></div>
        <div>
            <header class="flex items-center justify-between">
                <h1 class="text-white title-gradient text-4xl font-bold">Tell us about your project</h1>
            </header>

            <div class="mt-10">
                <p class="text-white">
                    While artificial intelligence can be great at understanding your code in many ways, there are still
                    areas that need human expertise and knowledge. Could you work with us to address these needs?
                    If your project involves specific terms or concepts, please feel free to provide them so that we can
                    customise our documentation and provide you with the best possible service.
                </p>

                <div class="mt-16">
                    <div class="flex justify-end items-center mb-16">

                        <button type="button"
                            class="border border-violet-500 hover:bg-violet-400 hover:bg-opacity-20 px-4 py-2 rounded-lg text-white font-medium uppercase flex items-center justify-between space-x-2"
                            x-on:click="Livewire.dispatch('openModal', { component: 'add-project-concept', arguments: { project: '{{ $project->id }}' }}); showBlur = !showBlur">
                            <svg width="15" height="15" viewBox="0 0 23 23" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20.8218 10.1678H12.8306V2.17659C12.8306 1.82336 12.6902 1.4846 12.4405 1.23482C12.1907 0.985048 11.8519 0.844727 11.4987 0.844727C11.1455 0.844727 10.8067 0.985048 10.5569 1.23482C10.3072 1.4846 10.1668 1.82336 10.1668 2.17659V10.1678H2.17562C1.82238 10.1678 1.48362 10.3081 1.23385 10.5579C0.984072 10.8077 0.84375 11.1464 0.84375 11.4997C0.84375 11.8529 0.984072 12.1917 1.23385 12.4414C1.48362 12.6912 1.82238 12.8315 2.17562 12.8315H10.1668V20.8228C10.1668 21.176 10.3072 21.5148 10.5569 21.7645C10.8067 22.0143 11.1455 22.1546 11.4987 22.1546C11.8519 22.1546 12.1907 22.0143 12.4405 21.7645C12.6902 21.5148 12.8306 21.176 12.8306 20.8228V12.8315H20.8218C21.175 12.8315 21.5138 12.6912 21.7635 12.4414C22.0133 12.1917 22.1536 11.8529 22.1536 11.4997C22.1536 11.1464 22.0133 10.8077 21.7635 10.5579C21.5138 10.3081 21.175 10.1678 20.8218 10.1678Z"
                                    fill="url(#paint0_linear_302_4131)" />
                                <defs>
                                    <linearGradient id="paint0_linear_302_4131" x1="11.4987" y1="0.844727"
                                        x2="11.4987" y2="22.1546" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="white" />
                                        <stop offset="0.885" stop-color="#9A88F5" />
                                    </linearGradient>
                                </defs>
                            </svg>

                            <span class="uppercase hidden sm:block text-base">Add Concept</span>
                            <span class="uppercase sm:hidden block text-base">Add</span>
                        </button>
                    </div>

                    <livewire:project-concept-list :project="$project">
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('openModal', (event) => {
                Livewire.dispatch('open')
            });
            Livewire.on('modalClosed', (event) => {
                Livewire.dispatch('close')
            });
        });
    </script>
</x-project-layout>
