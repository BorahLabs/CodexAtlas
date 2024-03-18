<div class="bg-dark w-full relative">
    <x-visuals.background-violet class="absolute top-0 z-10 left-0 w-full h-full" />
    <div class="p-7">
        <div class="flex justify-end w-full z-20">
            <button wire:click="$dispatch('closeModal')">
                <x-icons.close class="w-4 h-4 text-violet-500" />
            </button>
        </div>
        <div class="flex justify-center">
            <h3 class="mb-10 title-gradient text-2xl font-bold text-white">Tell us about your project</h3>
        </div>
        <div class="flex flex-col justify-center items-center w-full z-20">
            <div class="flex flex-col justify-start mb-5 w-full">

                <div class="p-[2px] mb-2 rounded-xl w-full bg-input-gradient z-20">
                    <div class="relative bg-dark rounded-xl">
                        <input wire:model="name" type="text"
                            class="pr-7 py-2 pl-2 w-full bg-dark text-white rounded-xl"
                            placeholder="Enter here your keyword" required>
                        <button type="button" wire:click="clearName" class="absolute top-3 right-2">
                            <x-icons.trash class="w-4 h-4" />
                        </button>
                    </div>
                </div>
                @error('name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col justify-start mb-5 w-full z-20">
                <div class="p-[2px] mb-2 flex justify-center items-center bg-input-gradient rounded-xl w-full relative">
                    <textarea wire:model="description" type="text"
                        class="bg-dark resize-none rounded-xl w-full h-full text-white placeholder-current" rows="6"
                        placeholder="Write here the definition of the concept..." required></textarea>

                    <div class="absolute bottom-2 right-2">
                        <x-icons.textarea-icon class="w-4 h-4"/>
                    </div>
                </div>
                @error('description')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-8 flex text-white space-x-2 z-20">
                <button type="button" wire:click="saveAndCreateAnother"
                    class="bg-gradient-to-b from-[#6242ff59] to-transparent p-px rounded-xl w-full flex relative">
                    <div class="bg-gradient-to-b from-[#6042ff] to-transparent p-px rounded-xl w-full flex">
                        <div class="bg-black p-2 rounded-xl text-white w-full flex justify-between items-center">
                            <svg width="23" height="23" viewBox="0 0 23 23" fill="none"
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
                            <span class="ml-2">SAVE AND ADD ANOTHER</span>
                        </div>
                    </div>
                </button>

                <button type="button" wire:click="save"
                    class="bg-violet-500 py-2 px-6 text-center rounded-xl text-dark font-medium">
                    SAVE
                </button>
            </div>
        </div>
    </div>
</div>
