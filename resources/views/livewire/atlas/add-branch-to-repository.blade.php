<div>
    @if ($isAddingBranch)
    @empty($branches)
        <p>No branches available</p>
    @else
        <form wire:submit="addBranch">
            <select wire:model="selectedBranch" class="px-2 py-1 rounded-md bg-black text-xs">
                <option value="">Select branch</option>
                @foreach ($branches as $branch)
                    <option value="{{ $branch }}">{{ $branch }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-violet-500 px-4 py-1 text-white rounded-md mt-1">Add</button>
        </form>
    @endempty
@else
    <button type="button" class="cursor-pointer hover:underline" wire:click="startAddingBranch">+ Add branch</button>
@endif
</div>
