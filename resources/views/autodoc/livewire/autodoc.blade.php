<div>
    <div class="grid grid-cols-2 gap-8">
        <div class="max-w-prose">
            <div class="flex overflow-hidden">
                @for ($i = 0; $i < 50; $i++)
                    <div class="triangle rotate-180"></div>
                @endfor
            </div>
            <div class="bg-white p-8 h-[40rem] overflow-auto prose">
                @if ($completion)
                    {!! Str::markdown($completion) !!}
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
                {{-- "# Your file name here\n## How it works\n1. Upload a `.zip` file containing your code\n2. We will show you how your documentation could look\n3. Once the payment is processed, you will get an email with your whole project documented", --}}
            </div>
            <div class="flex overflow-hidden">
                @for ($i = 0; $i < 50; $i++)
                    <div class="triangle"></div>
                @endfor
            </div>
        </div>
        <div class="bg-white rounded-md p-8">
            @if ($email)
                @if ($zipPath)
                    <div wire:key="step-2" wire:init="processFirstFile">
                        <div wire:loading.block wire:target="processFirstFile">
                            Processing file...
                        </div>

                        <p>We found {{ $numberOfFiles }} documentable files in your project.</p>
                        <p>Price: {{ $this->formattedPrice }}</p>
                    </div>
                @else
                    <form wire:key="step-1" wire:submit="uploadFile">
                        {{ $this->form }}
                        <x-filament::button type="submit">Upload</x-filament::button>
                    </form>
                @endif
            @else
                <form wire:key="step-0" wire:submit="submitEmail">
                    <x-filament::input type="email" wire:model="email" />
                    <x-filament::button type="submit">Start documenting my code</x-filament::button>
                </form>
            @endif
        </div>
    </div>
</div>
