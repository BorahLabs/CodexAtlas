<form wire:submit="submitEmail">
    {{ $this->form }}
    @if ($captchaError)
        <p class="text-red-500">The captcha resolution was not successful</p>
    @endif
    <x-filament::button type="submit" class="w-full mt-8">Start documenting my code</x-filament::button>
    <p class="text-gray-500 text-xs mt-2">
        By submitting your email, you agree to our <a href="{{ route('autodoc.terms') }}" target="_blank"
            class="underline">
            terms and
            conditions
        </a> and our
        <a href="{{ route('autodoc.privacy') }}" target="_blank" class="underline">
            privacy policy
        </a>
    </p>
</form>
