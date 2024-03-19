<div class="bg-dark w-full relative">
    <x-visuals.background-violet class="absolute top-0 z-10 left-0 w-full h-full" />
    <div class="p-7 w-full">
        <div class="flex justify-center w-full items-center">
            <x-icons.trash class="w-20 h-20" />
        </div>

        <div class="flex flex-col text-center">
            <h4 class="text-white text-xl mt-2 mb-4">Delete
                <span class="font-bold">
                    {{$concept->name}}
                </span>
            </h4>
            <span class="text-white">Are you sure you want to delete this
                 project concept? This action can not be undone</span>
        </div>

        <div class="mt-10 flex justify-between text-white space-x-2 z-20">
            <button type="button" wire:click="$dispatch('closeModal')"
                class="bg-gradient-to-b from-[#6242ff59] to-transparent p-px rounded-xl w-1/2 flex relative z-20 text-center button-hover-white">
                <div class="bg-gradient-to-b from-[#6042ff] to-transparent p-px rounded-xl w-full flex">
                    <div class="bg-black p-2 rounded-xl text-white w-full flex justify-center items-center">
                        Cancel
                    </div>
                </div>
            </button>

            <button type="button" wire:click="confirm" class="button-hover-white rounded-lg relative z-20 w-1/2 border border-violet-500 bg-violet-500">
                Confirm
            </button>
        </div>
    </div>
</div>
