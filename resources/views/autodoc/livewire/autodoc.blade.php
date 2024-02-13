<div>
    <div class="grid grid-cols-2 gap-8">
        <div class="max-w-prose">
            <div class="flex overflow-hidden">
                @for ($i = 0; $i < 50; $i++)
                    <div class="triangle rotate-180"></div>
                @endfor
            </div>
            <div class="bg-white p-8 h-[40rem] overflow-auto prose">
                <div wire:loading wire:target="processFirstFile">
                    <x-autodoc.number1 />
                    <h1>Generating first draft...</h1>
                    <p>🔍 We are analyzing your code to estimate the cost of documenting your project</p>
                    <p>⏳ This process can take up to 1 minute</p>
                </div>
                <div wire:loading.remove wire:target="processFirstFile">
                    @if ($lead?->first_file_completion)
                        {!! Str::markdown($lead?->first_file_completion) !!}
                    @else
                        <x-autodoc.number1 />
                        <h1>Create documentation for your project in seconds using AI</h1>
                        <p>Save money and use AI to generate the documentation for your project instead of spending your
                            developers' time on it.</p>
                        <p>✏️ Upload your code and <u>preview</u> how the docs will look, <u>for free</u></p>
                        <p>⏳ Use your developers' time to <u>create new features</u></p>
                        <p>💸 <u>Avoid high onboarding costs</u> for new team members due to lack of documentation</p>
                        <p>✅ Receive the <u>documentation for the relevant files</u> in minutes in your email</p>
                        <p>🔒 Your code will be deleted from our servers right after it's processed</p>
                    @endif
                </div>
            </div>
            <div class="flex overflow-hidden">
                @for ($i = 0; $i < 50; $i++)
                    <div class="triangle"></div>
                @endfor
            </div>
        </div>
        <div class="bg-gray-950 dark rounded-md p-8 self-center">
            @if ($lead)
                @if ($lead->zip_path)
                    <div wire:key="step-2" wire:init="processFirstFile" class="prose prose-invert">
                        <h1 wire:loading wire:target="processFirstFile">Generating first draft...</h1>
                        <h1 wire:loading.remove wire:target="processFirstFile">Analysis completed!</h1>
                        <p>🛠️ We detected your project is using <strong>{{ $lead->framework }}</strong>.</p>
                        <p>✏️ We will generate the documentation for <strong>{{ $lead->number_of_files }} files</strong>
                            in your project.</p>
                        <p>✉️ You will receive an email with your documentation in Markdown format in less than one
                            hour.</p>
                        <p>💵 Total cost: <strong>{{ $this->formattedPrice }}</strong></p>

                        <div wire:loading.remove wire:target="processFirstFile">
                            <x-filament::button type="button" wire:click="pay">Send me my
                                documentation</x-filament::button>
                        </div>
                    </div>
                @else
                    <div wire:key="step-1">
                        <livewire:autodoc.upload-file :lead="$lead" />
                    </div>
                @endif
            @else
                <div wire:key="step-0">
                    <livewire:autodoc.get-started-form />
                </div>
            @endif
        </div>
    </div>
</div>
