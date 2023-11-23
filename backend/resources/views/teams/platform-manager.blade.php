<div>
    <x-section-border />

    <div class="mt-10 sm:mt-0">
        <x-form-section submit="savePlatform">
            <x-slot name="title">
                {{ __('Your platform') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Your own documentation platform, where you and your team can access to the documentation.') }}
            </x-slot>

            <x-slot name="form">
                <!-- Platform Domain -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="domain" value="{{ __('Subdomain') }}" />
                    <div class="flex">
                        <x-input id="domain" type="text" class="mt-1 block w-full border-r-0"
                            wire:model="subdomain" />
                        <span
                            class="mt-1 px-4 flex items-center justify-center text-slate-50 font-medium">.{{ config('app.main_domain') }}</span>
                    </div>
                    <x-input-error for="subdomain" class="mt-2" />
                </div>

            </x-slot>

            <x-slot name="actions">
                <x-action-message class="me-3" on="saved">
                    {{ __('Your domain was successfully updated.') }}
                </x-action-message>

                <x-button>
                    {{ __('Update') }}
                </x-button>
            </x-slot>
        </x-form-section>
    </div>
</div>
