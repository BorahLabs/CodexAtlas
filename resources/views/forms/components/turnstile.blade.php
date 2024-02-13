<div x-on:turnstile.window="(e) => {
    $wire.set('{{ $getStatePath() }}', e.detail);
}" wire:ignore>
    <div class="cf-turnstile" data-sitekey="{{ config('services.cloudflare.turnstile.site_key') }}"
        data-callback="onTurnstile"></div>
</div>
