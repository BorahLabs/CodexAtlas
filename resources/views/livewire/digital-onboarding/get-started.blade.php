<div>
    <x-digitalonboarding.decoration />
    <x-filament::section class="relative" :heading="'Welcome to '.$project->name" description="Here's a brief introduction to our project. At the end of this onboarding, you will be able to run the project in your computer and start working.">
        <div class="prose prose-lg max-w-none">
          {!! Str::markdown($project->context) !!}
        </div>
        <x-digitalonboarding.navigation next="Get started" />
      </x-filament::section>
</div>
