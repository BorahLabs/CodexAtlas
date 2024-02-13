<form wire:submit="submitEmail">
    {{ $this->form }}
    @if ($captchaError)
        <p class="text-red-500">The captcha resolution was not successful</p>
    @endif
    <x-filament::button type="submit" class="w-full">Start documenting my code</x-filament::button>
</form>
