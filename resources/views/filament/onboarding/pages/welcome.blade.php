<x-filament-panels::page>
    <p>
        We're here to help your company {{ auth()->user()->currentTeam->name }} to easily
        onboard new developers in your team and into a
        new project.
        <br>We're so excited you've taken this big step with us! 🎉
    </p>
    <x-filament::section>
        <x-slot name="heading">
            How Digital Onboarding Works
        </x-slot>

        <x-slot name="description">
            Read the following steps to understand how Digital Onboarding works.
        </x-slot>

        <div class="prose prose-invert">
            <p>
                Digital Onboarding is s tool that improves the onboarding process for new developers in your team by
                keeping all the necessary information in one place:
            </p>
            <ul>
                <li>Project information</li>
                <li>Team information</li>
                <li>Development environment setup</li>
                <li>Development workflow</li>
                <li>Automated code documentation provided by Codex</li>
                <li>Relevant links and resources</li>
                <li>AI-based support while onboarding</li>
            </ul>
            <p>
                To get started, first you need to create your first project. Click the button below to get started!
            </p>

            <x-filament::button type="button" wire:click="getStarted">
                Get started
            </x-filament::button>
        </div>
    </x-filament::section>
</x-filament-panels::page>
