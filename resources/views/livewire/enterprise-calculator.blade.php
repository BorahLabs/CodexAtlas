<div>
    @if ($demoScheduled)
        <div wire:key="demoScheduled">
            <div class="relative flex justify-center flex-col items-center text-center py-10">
                <x-codex.icons.check class="h-32 w-32 text-violet-100" />
                <p class="text-violet-100 text-xl mt-8 max-w-md">
                    Thanks! We have received your request for a demo call and our team will contact you soon.
                </p>
            </div>
        </div>
    @else
        <div class="relative grid gap-16 grid-cols-1 lg:grid-cols-2 lg:gap-24 px-4 lg:px-10" wire:key>
            <div>
                <div class="relative py-10 text-white font-bold">

                    <p>1. How many developers do you have?</p>
                    <div class="rounded-lg overflow-hidden flex mt-2">
                        <input type="number" min="1"
                            class="w-full p-2 bg-white bg-opacity-20 text-white rounded-none border-0"
                            wire:model.live="numberOfDevs">
                        <span
                            class="flex justify-center items-center px-2 leading-none border-l border-l-white border-opacity-50 bg-white bg-opacity-20">developers</span>
                    </div>
                    <p class="text-xs text-gray-100 font-normal mt-1">
                        This number is just used to calculate how many code changes we can expect in a day of work.
                    </p>

                    <p class="mt-8">2. How much does a developer cost per hour?</p>
                    <div class="rounded-lg overflow-hidden flex mt-2">
                        <input type="number" min="1"
                            class="w-full p-2 bg-white bg-opacity-20 text-white rounded-none border-0"
                            wire:model.live="devPricePerHour">
                        <span
                            class="flex justify-center items-center px-2 leading-none border-l border-l-white border-opacity-50 bg-white bg-opacity-20">EUR</span>
                    </div>
                    <p class="text-xs text-gray-100 font-normal mt-1">
                        This will be used to calculate the cost of the time spent writing documentation.
                    </p>

                    <p class="mt-8">3. How many projects would you like to keep documented?</p>
                    <div class="rounded-lg overflow-hidden flex mt-2">
                        <input type="number" min="1"
                            class="w-full p-2 bg-white bg-opacity-20 text-white rounded-none border-0"
                            wire:model.live="numberOfProjects">
                        <span
                            class="flex justify-center items-center px-2 leading-none border-l border-l-white border-opacity-50 bg-white bg-opacity-20">projects</span>
                    </div>
                    <p class="text-xs text-gray-100 font-normal mt-1">
                        You can have as many projects as you want. Just bear in mind that the more projects you have,
                        the
                        slower
                        the system will keep everything up to date unless we meet the power requirements.
                    </p>

                    <p class="mt-8">4. How soon would you need the documentation ready?</p>
                    <div class="rounded-lg overflow-hidden flex mt-2">
                        <select class="w-full p-2 bg-white bg-opacity-20 text-white rounded-none border-0"
                            wire:model.live="documentationReadiness">
                            <option value="1">It could wait 1-2 days</option>
                            <option value="2">Within hours</option>
                            <option value="3">As soon as possible</option>
                        </select>
                    </div>
                    <p class="text-xs text-gray-100 font-normal mt-1">
                        The sooner you need it, the setup fee will be higher since we will need a more powerful
                        computer.
                    </p>
                </div>
            </div>
            <div>
                <div class="relative py-10">
                    <div class="flex flex-wrap mb-8">
                        <span class="block text-4xl font-semibold text-white lg:text-5xl">
                            {{ number_format($this->price, 0, ',', '.') }} &euro;
                        </span>
                        <p class="text-gray-300 mt-2 text-sm">
                            This price is a <strong>one-time payment</strong> to keep your code documented
                            <strong>forever</strong>. The price is an estimate based on the information you provided.
                            The
                            final
                            price may vary depending on different factors.
                        </p>
                        <div class="p-4 bg-violet-300 bg-opacity-30 rounded-md mt-4 w-full">
                            <p class="text-sm text-gray-300">
                                In a year <strong>you would be paying between
                                    {{ number_format($this->minDocumentationCost, 0, ',', '.') }}&euro; and
                                    {{ number_format($this->maxDocumentationCost, 0, ',', '.') }}&euro;</strong>
                                to your developers just to document the code (~10-20% of their
                                time).
                            </p>
                        </div>
                    </div>
                    <div>
                        <span class="block mb-4 text-lg font-medium text-white tracking-tight">
                            What would be included:
                        </span>
                        <ul class="mb-8 space-y-4">
                            <li class="flex items-center">
                                <div class="flex mr-2 items-center justify-center w-5 h-5 rounded-full bg-green-600">
                                    <svg width="16" height="16" viewbox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.4732 4.80667C12.4112 4.74418 12.3375 4.69458 12.2563 4.66074C12.175 4.62689 12.0879 4.60947 11.9999 4.60947C11.9119 4.60947 11.8247 4.62689 11.7435 4.66074C11.6623 4.69458 11.5885 4.74418 11.5266 4.80667L6.55989 9.78L4.47322 7.68667C4.40887 7.62451 4.33291 7.57563 4.24967 7.54283C4.16644 7.51003 4.07755 7.49394 3.9881 7.49549C3.89865 7.49703 3.81037 7.51619 3.72832 7.55185C3.64627 7.58751 3.57204 7.63898 3.50989 7.70333C3.44773 7.76768 3.39885 7.84364 3.36605 7.92688C3.33324 8.01011 3.31716 8.099 3.31871 8.18845C3.32025 8.2779 3.3394 8.36618 3.37507 8.44823C3.41073 8.53028 3.4622 8.60451 3.52655 8.66667L6.08655 11.2267C6.14853 11.2892 6.22226 11.3387 6.3035 11.3726C6.38474 11.4064 6.47188 11.4239 6.55989 11.4239C6.64789 11.4239 6.73503 11.4064 6.81627 11.3726C6.89751 11.3387 6.97124 11.2892 7.03322 11.2267L12.4732 5.78667C12.5409 5.72424 12.5949 5.64847 12.6318 5.56414C12.6688 5.4798 12.6878 5.38873 12.6878 5.29667C12.6878 5.2046 12.6688 5.11353 12.6318 5.02919C12.5949 4.94486 12.5409 4.86909 12.4732 4.80667Z"
                                            fill="black"></path>
                                    </svg>
                                </div>
                                <span class="text-base text-white tracking-tight">Unlimited projects</span>
                            </li>
                            <li class="flex items-center">
                                <div class="flex mr-2 items-center justify-center w-5 h-5 rounded-full bg-green-600">
                                    <svg width="16" height="16" viewbox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.4732 4.80667C12.4112 4.74418 12.3375 4.69458 12.2563 4.66074C12.175 4.62689 12.0879 4.60947 11.9999 4.60947C11.9119 4.60947 11.8247 4.62689 11.7435 4.66074C11.6623 4.69458 11.5885 4.74418 11.5266 4.80667L6.55989 9.78L4.47322 7.68667C4.40887 7.62451 4.33291 7.57563 4.24967 7.54283C4.16644 7.51003 4.07755 7.49394 3.9881 7.49549C3.89865 7.49703 3.81037 7.51619 3.72832 7.55185C3.64627 7.58751 3.57204 7.63898 3.50989 7.70333C3.44773 7.76768 3.39885 7.84364 3.36605 7.92688C3.33324 8.01011 3.31716 8.099 3.31871 8.18845C3.32025 8.2779 3.3394 8.36618 3.37507 8.44823C3.41073 8.53028 3.4622 8.60451 3.52655 8.66667L6.08655 11.2267C6.14853 11.2892 6.22226 11.3387 6.3035 11.3726C6.38474 11.4064 6.47188 11.4239 6.55989 11.4239C6.64789 11.4239 6.73503 11.4064 6.81627 11.3726C6.89751 11.3387 6.97124 11.2892 7.03322 11.2267L12.4732 5.78667C12.5409 5.72424 12.5949 5.64847 12.6318 5.56414C12.6688 5.4798 12.6878 5.38873 12.6878 5.29667C12.6878 5.2046 12.6688 5.11353 12.6318 5.02919C12.5949 4.94486 12.5409 4.86909 12.4732 4.80667Z"
                                            fill="black"></path>
                                    </svg>
                                </div>
                                <span class="text-base text-white tracking-tight">
                                    Unlimited developers
                                </span>
                            </li>
                            <li class="flex items-center">
                                <div class="flex mr-2 items-center justify-center w-5 h-5 rounded-full bg-green-600">
                                    <svg width="16" height="16" viewbox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.4732 4.80667C12.4112 4.74418 12.3375 4.69458 12.2563 4.66074C12.175 4.62689 12.0879 4.60947 11.9999 4.60947C11.9119 4.60947 11.8247 4.62689 11.7435 4.66074C11.6623 4.69458 11.5885 4.74418 11.5266 4.80667L6.55989 9.78L4.47322 7.68667C4.40887 7.62451 4.33291 7.57563 4.24967 7.54283C4.16644 7.51003 4.07755 7.49394 3.9881 7.49549C3.89865 7.49703 3.81037 7.51619 3.72832 7.55185C3.64627 7.58751 3.57204 7.63898 3.50989 7.70333C3.44773 7.76768 3.39885 7.84364 3.36605 7.92688C3.33324 8.01011 3.31716 8.099 3.31871 8.18845C3.32025 8.2779 3.3394 8.36618 3.37507 8.44823C3.41073 8.53028 3.4622 8.60451 3.52655 8.66667L6.08655 11.2267C6.14853 11.2892 6.22226 11.3387 6.3035 11.3726C6.38474 11.4064 6.47188 11.4239 6.55989 11.4239C6.64789 11.4239 6.73503 11.4064 6.81627 11.3726C6.89751 11.3387 6.97124 11.2892 7.03322 11.2267L12.4732 5.78667C12.5409 5.72424 12.5949 5.64847 12.6318 5.56414C12.6688 5.4798 12.6878 5.38873 12.6878 5.29667C12.6878 5.2046 12.6688 5.11353 12.6318 5.02919C12.5949 4.94486 12.5409 4.86909 12.4732 4.80667Z"
                                            fill="black"></path>
                                    </svg>
                                </div>
                                <span class="text-base text-white tracking-tight">
                                    Integrations with Notion, Confluence, and more
                                </span>
                            </li>
                            <li class="flex items-center">
                                <div class="flex mr-2 items-center justify-center w-5 h-5 rounded-full bg-green-600">
                                    <svg width="16" height="16" viewbox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.4732 4.80667C12.4112 4.74418 12.3375 4.69458 12.2563 4.66074C12.175 4.62689 12.0879 4.60947 11.9999 4.60947C11.9119 4.60947 11.8247 4.62689 11.7435 4.66074C11.6623 4.69458 11.5885 4.74418 11.5266 4.80667L6.55989 9.78L4.47322 7.68667C4.40887 7.62451 4.33291 7.57563 4.24967 7.54283C4.16644 7.51003 4.07755 7.49394 3.9881 7.49549C3.89865 7.49703 3.81037 7.51619 3.72832 7.55185C3.64627 7.58751 3.57204 7.63898 3.50989 7.70333C3.44773 7.76768 3.39885 7.84364 3.36605 7.92688C3.33324 8.01011 3.31716 8.099 3.31871 8.18845C3.32025 8.2779 3.3394 8.36618 3.37507 8.44823C3.41073 8.53028 3.4622 8.60451 3.52655 8.66667L6.08655 11.2267C6.14853 11.2892 6.22226 11.3387 6.3035 11.3726C6.38474 11.4064 6.47188 11.4239 6.55989 11.4239C6.64789 11.4239 6.73503 11.4064 6.81627 11.3726C6.89751 11.3387 6.97124 11.2892 7.03322 11.2267L12.4732 5.78667C12.5409 5.72424 12.5949 5.64847 12.6318 5.56414C12.6688 5.4798 12.6878 5.38873 12.6878 5.29667C12.6878 5.2046 12.6688 5.11353 12.6318 5.02919C12.5949 4.94486 12.5409 4.86909 12.4732 4.80667Z"
                                            fill="black"></path>
                                    </svg>
                                </div>
                                <span class="text-base text-white tracking-tight">
                                    Prompt injection (to change documentation format)
                                </span>
                            </li>
                            <li class="flex items-center">
                                <div class="flex mr-2 items-center justify-center w-5 h-5 rounded-full bg-green-600">
                                    <svg width="16" height="16" viewbox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.4732 4.80667C12.4112 4.74418 12.3375 4.69458 12.2563 4.66074C12.175 4.62689 12.0879 4.60947 11.9999 4.60947C11.9119 4.60947 11.8247 4.62689 11.7435 4.66074C11.6623 4.69458 11.5885 4.74418 11.5266 4.80667L6.55989 9.78L4.47322 7.68667C4.40887 7.62451 4.33291 7.57563 4.24967 7.54283C4.16644 7.51003 4.07755 7.49394 3.9881 7.49549C3.89865 7.49703 3.81037 7.51619 3.72832 7.55185C3.64627 7.58751 3.57204 7.63898 3.50989 7.70333C3.44773 7.76768 3.39885 7.84364 3.36605 7.92688C3.33324 8.01011 3.31716 8.099 3.31871 8.18845C3.32025 8.2779 3.3394 8.36618 3.37507 8.44823C3.41073 8.53028 3.4622 8.60451 3.52655 8.66667L6.08655 11.2267C6.14853 11.2892 6.22226 11.3387 6.3035 11.3726C6.38474 11.4064 6.47188 11.4239 6.55989 11.4239C6.64789 11.4239 6.73503 11.4064 6.81627 11.3726C6.89751 11.3387 6.97124 11.2892 7.03322 11.2267L12.4732 5.78667C12.5409 5.72424 12.5949 5.64847 12.6318 5.56414C12.6688 5.4798 12.6878 5.38873 12.6878 5.29667C12.6878 5.2046 12.6688 5.11353 12.6318 5.02919C12.5949 4.94486 12.5409 4.86909 12.4732 4.80667Z"
                                            fill="black"></path>
                                    </svg>
                                </div>
                                <span class="text-base text-white tracking-tight">
                                    Privacy-first approach
                                </span>
                            </li>
                            <li class="flex items-center">
                                <div class="flex mr-2 items-center justify-center w-5 h-5 rounded-full bg-green-600">
                                    <svg width="16" height="16" viewbox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.4732 4.80667C12.4112 4.74418 12.3375 4.69458 12.2563 4.66074C12.175 4.62689 12.0879 4.60947 11.9999 4.60947C11.9119 4.60947 11.8247 4.62689 11.7435 4.66074C11.6623 4.69458 11.5885 4.74418 11.5266 4.80667L6.55989 9.78L4.47322 7.68667C4.40887 7.62451 4.33291 7.57563 4.24967 7.54283C4.16644 7.51003 4.07755 7.49394 3.9881 7.49549C3.89865 7.49703 3.81037 7.51619 3.72832 7.55185C3.64627 7.58751 3.57204 7.63898 3.50989 7.70333C3.44773 7.76768 3.39885 7.84364 3.36605 7.92688C3.33324 8.01011 3.31716 8.099 3.31871 8.18845C3.32025 8.2779 3.3394 8.36618 3.37507 8.44823C3.41073 8.53028 3.4622 8.60451 3.52655 8.66667L6.08655 11.2267C6.14853 11.2892 6.22226 11.3387 6.3035 11.3726C6.38474 11.4064 6.47188 11.4239 6.55989 11.4239C6.64789 11.4239 6.73503 11.4064 6.81627 11.3726C6.89751 11.3387 6.97124 11.2892 7.03322 11.2267L12.4732 5.78667C12.5409 5.72424 12.5949 5.64847 12.6318 5.56414C12.6688 5.4798 12.6878 5.38873 12.6878 5.29667C12.6878 5.2046 12.6688 5.11353 12.6318 5.02919C12.5949 4.94486 12.5409 4.86909 12.4732 4.80667Z"
                                            fill="black"></path>
                                    </svg>
                                </div>
                                <span class="text-base text-white tracking-tight">
                                    Free, lifetime updates
                                </span>
                            </li>
                            <li class="flex items-center">
                                <div class="flex mr-2 items-center justify-center w-5 h-5 rounded-full bg-green-600">
                                    <svg width="16" height="16" viewbox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.4732 4.80667C12.4112 4.74418 12.3375 4.69458 12.2563 4.66074C12.175 4.62689 12.0879 4.60947 11.9999 4.60947C11.9119 4.60947 11.8247 4.62689 11.7435 4.66074C11.6623 4.69458 11.5885 4.74418 11.5266 4.80667L6.55989 9.78L4.47322 7.68667C4.40887 7.62451 4.33291 7.57563 4.24967 7.54283C4.16644 7.51003 4.07755 7.49394 3.9881 7.49549C3.89865 7.49703 3.81037 7.51619 3.72832 7.55185C3.64627 7.58751 3.57204 7.63898 3.50989 7.70333C3.44773 7.76768 3.39885 7.84364 3.36605 7.92688C3.33324 8.01011 3.31716 8.099 3.31871 8.18845C3.32025 8.2779 3.3394 8.36618 3.37507 8.44823C3.41073 8.53028 3.4622 8.60451 3.52655 8.66667L6.08655 11.2267C6.14853 11.2892 6.22226 11.3387 6.3035 11.3726C6.38474 11.4064 6.47188 11.4239 6.55989 11.4239C6.64789 11.4239 6.73503 11.4064 6.81627 11.3726C6.89751 11.3387 6.97124 11.2892 7.03322 11.2267L12.4732 5.78667C12.5409 5.72424 12.5949 5.64847 12.6318 5.56414C12.6688 5.4798 12.6878 5.38873 12.6878 5.29667C12.6878 5.2046 12.6688 5.11353 12.6318 5.02919C12.5949 4.94486 12.5409 4.86909 12.4732 4.80667Z"
                                            fill="black"></path>
                                    </svg>
                                </div>
                                <span class="text-base text-white tracking-tight">
                                    1-year maintenance
                                </span>
                            </li>
                        </ul>

                        <p class="font-bold text-white mb-1">Your company email:<sup>*</sup></p>
                        <input type="text"
                            class="w-full p-2 mb-8 bg-white bg-opacity-20 text-white rounded-md border-0"
                            wire:model="companyEmail" placeholder="john.doe@example.com">

                        <button type="button" wire:click="askForDemoCall" wire:loading.attr="disabled"
                            class="group inline-flex w-full md:w-auto h-14 px-7 items-center justify-center text-base font-medium text-black hover:text-white bg-violet-500 hover:bg-black transition duration-200 rounded-full">
                            <span class="mr-2">Ask for a demo call</span>
                            <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M17.9199 6.62C17.8185 6.37565 17.6243 6.18147 17.3799 6.08C17.2597 6.02876 17.1306 6.00158 16.9999 6H6.99994C6.73472 6 6.48037 6.10536 6.29283 6.29289C6.1053 6.48043 5.99994 6.73478 5.99994 7C5.99994 7.26522 6.1053 7.51957 6.29283 7.70711C6.48037 7.89464 6.73472 8 6.99994 8H14.5899L6.28994 16.29C6.19621 16.383 6.12182 16.4936 6.07105 16.6154C6.02028 16.7373 5.99414 16.868 5.99414 17C5.99414 17.132 6.02028 17.2627 6.07105 17.3846C6.12182 17.5064 6.19621 17.617 6.28994 17.71C6.3829 17.8037 6.4935 17.8781 6.61536 17.9289C6.73722 17.9797 6.86793 18.0058 6.99994 18.0058C7.13195 18.0058 7.26266 17.9797 7.38452 17.9289C7.50638 17.8781 7.61698 17.8037 7.70994 17.71L15.9999 9.41V17C15.9999 17.2652 16.1053 17.5196 16.2928 17.7071C16.4804 17.8946 16.7347 18 16.9999 18C17.2652 18 17.5195 17.8946 17.707 17.7071C17.8946 17.5196 17.9999 17.2652 17.9999 17V7C17.9984 6.86932 17.9712 6.74022 17.9199 6.62Z"
                                    fill="currentColor"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
