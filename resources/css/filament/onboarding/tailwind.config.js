import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/Onboarding/**/*.php',
        './resources/views/filament/onboarding/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
}
