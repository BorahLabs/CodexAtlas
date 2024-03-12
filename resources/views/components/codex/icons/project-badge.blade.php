<div class="flex items-center justify-center relative">
    <img src="{{ asset('images/project-badge.png') }}" alt="" class="w-[108px] h-auto block">
    <x-dynamic-component :component="'codex.project-icons.' . ($iconName ?? 'robot')" class="absolute left-0 right-0 bottom-0 top-0 m-auto h-8 w-auto" />
</div>
