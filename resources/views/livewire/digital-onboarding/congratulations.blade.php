<div>
    <x-digitalonboarding.decoration />
    <x-filament::section class="relative">

        <div class="prose">
            <x-heroicon-o-check-circle class="text-success-500 h-24 w-24" />
            <h1>You did it!</h1>
            <p>
                Congratulations for completing the onboarding! This is the first step to becoming an important developer for {{ $project->name }} and especially for our company.
            </p>
            <p>
                Thank you for your time and hope you have fun completing your first task!
            </p>
        </div>
        <x-digitalonboarding.navigation previous="Back" next="Start again" />
      </x-filament::section>
</div>
