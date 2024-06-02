<div class="p-4 bg-white bg-opacity-15 mt-8 rounded-xl sm:flex sm:justify-between sm:items-center">
    <p class="text-base font-bold">Did you find this useful?</p>
    <div>
        <button type="button" @class([
            'w-full mt-2 px-4 py-2 bg-white rounded-xl hover:bg-opacity-50 sm:w-auto sm:mt-0',
            'bg-opacity-30' => !$this->feedback?->is_helpful,
            'bg-opacity-100' => $this->feedback?->is_helpful,
        ]) aria-label="Yes" wire:click="setHelpful(true)">
            👍
        </button>
        <button type="button" @class([
            'w-full mt-2 px-4 py-2 bg-white rounded-xl hover:bg-opacity-50 sm:w-auto sm:mt-0',
            'bg-opacity-30' =>
                is_null($this->feedback?->is_helpful) || $this->feedback?->is_helpful,
            'bg-opacity-100' => $this->feedback?->is_helpful === false,
        ]) aria-label="No" wire:click="setHelpful(false)">
            👎
        </button>
    </div>
</div>
