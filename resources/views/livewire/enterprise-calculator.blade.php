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
        <div class="relative grid gap-16 grid-cols-1 lg:grid-cols-2 {{ $simpleMode ? 'lg:gap-12' : 'lg:gap-24' }}"
            wire:key="calculator">
            <x-bordered-black-box :single="true">
                <x-stars class="absolute left-0 bottom-0 w-full pointer-events-none" />
                <div class="relative py-10 text-white font-bold">
                    <p>1. How many developers do you have?</p>
                    <div class="relative mt-2">
                        <x-bordered-input wire:model.live="numberOfDevs" type="number" min="1" class="pr-12" />
                        <svg width="16" height="21" viewBox="0 0 16 21" fill="none"
                            class="absolute right-4 top-0 bottom-0 my-auto" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M3.63576 4.5C3.63576 2.01472 5.5897 0 8 0C10.4103 0 12.3642 2.01472 12.3642 4.5C12.3642 6.98528 10.4103 9 8 9C5.5897 9 3.63576 6.98528 3.63576 4.5Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M0.000108556 18.6053C0.0751154 14.1156 3.62799 10.5 8 10.5C12.3721 10.5 15.925 14.1157 15.9999 18.6056C16.0049 18.9034 15.8385 19.176 15.576 19.3002C13.2688 20.3918 10.7024 21 8.00031 21C5.29791 21 2.73133 20.3917 0.423998 19.2999C0.161494 19.1757 -0.00486601 18.9031 0.000108556 18.6053Z"
                                fill="white" />
                        </svg>
                    </div>
                    @if (!$simpleMode)
                        <p class="text-xs text-[#B4A5FF] font-normal mt-1">
                            This number is just used to calculate how many code changes we can expect in a day of work.
                        </p>
                    @endif

                    <p class="mt-8">2. How much does a developer cost per hour?</p>
                    <div class="relative mt-2">
                        <x-bordered-input wire:model.live="devPricePerHour" type="number" min="1"
                            class="pr-14" />
                        <span class="absolute right-4 top-0 bottom-0 flex items-center justify-end font-bold">
                            EUR
                        </span>
                    </div>
                    @if (!$simpleMode)
                        <p class="text-xs text-[#B4A5FF] font-normal mt-1">
                            This will be used to calculate the cost of the time spent writing documentation.
                        </p>
                    @endif

                    @if (!$simpleMode)
                        <p class="mt-8">3. How fast do you need the documentation updated?</p>
                        <div class="rounded-lg overflow-hidden flex mt-2">
                            <select class="w-full p-2 bg-white bg-opacity-20 text-white rounded-none border-0"
                                wire:model.live="documentationReadiness">
                                <option value="1">It could wait 1-2 days</option>
                                <option value="2">Within hours</option>
                                <option value="3">As soon as possible</option>
                            </select>
                        </div>
                        <p class="text-xs text-[#B4A5FF] font-normal mt-1">
                            The sooner you need it, the setup fee will be higher since we will need a more powerful
                            computer.
                        </p>
                    @endif
                </div>
            </x-bordered-black-box>
            <div>
                <div class="relative">
                    <h2 class="text-secondary-gradient font-bold text-3xl">Currently paying for</h2>
                    <div class="flex flex-wrap items-end gap-2 mt-4">
                        @for ($i = 0; $i < min(20, $numberOfDevs); $i++)
                            <x-homepage.icons.user wire:key="user_{{ $i }}" />
                        @endfor
                        <span class="text-[#B2A4FA] text-lg font-normal ml-auto">({{ $numberOfDevs }} developers)</span>
                    </div>
                    <div class="mt-12">
                        <div class="relative w-full flex items-center">
                            <div
                                class="absolute w-full h-[9.5rem] top-0 bottom-0 my-auto left-5 rounded-l-[100px] rounded-r-xl bg-[#02051D]">
                            </div>
                            <x-homepage.price-chart class="h-48 w-48 relative">
                                <div>
                                    <span
                                        class="block text-center font-bold text-white text-2xl">{{ number_format($this->maxDocumentationCost, 0, ',', '.') }}
                                        &euro;</span>
                                    <span class="text-[#B2A4FA] text-center block">every year</span>
                                </div>
                            </x-homepage.price-chart>
                            <p class="text-sm text-gray-300 relative ml-8">
                                <strong>Every year you pay
                                    {{ number_format($this->maxDocumentationCost, 0, ',', '.') }}&euro;</strong>
                                to your developers to document their code, understand it and on onboardings.
                                <br>(~20% of their time)
                            </p>
                        </div>
                    </div>
                    @if (!$simpleMode)
                        <div class="mt-12">
                            <h2 class="text-secondary-gradient font-bold text-3xl">One-time payment with Codex</h2>
                            <div class="mt-12">
                                <div class="relative w-full flex items-center overflow-visible">
                                    <div
                                        class="absolute w-full h-[9.5rem] top-0 bottom-0 my-auto left-5 rounded-l-[100px] rounded-r-xl bg-[#02051D]">
                                    </div>
                                    <x-homepage.price-circle class="h-48 w-48 relative">
                                        <div>
                                            <span
                                                class="block text-center font-bold text-white text-2xl">{{ number_format($this->price, 0, ',', '.') }}
                                                &euro;</span>
                                            <span class="text-[#B2A4FA] text-center block">one time</span>
                                        </div>
                                    </x-homepage.price-circle>
                                    <p class="text-sm text-gray-300 relative ml-8">
                                        This price is a <strong>one-time payment</strong> to keep your code documented
                                        <strong>forever</strong>, in your own server. The price is an estimate based on
                                        the information you
                                        provided.
                                        The final price may vary depending on different factors.
                                    </p>
                                    <svg class="absolute -right-4 -top-12" width="92" height="93"
                                        viewBox="0 0 92 93" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_480_1581)">
                                            <path
                                                d="M64.3127 53.0669C63.9905 54.1915 62.8974 54.8662 61.7695 54.683C60.6412 54.5019 59.7663 53.5177 59.8683 52.3544C59.9643 51.2846 60.1507 50.2096 60.4363 49.1751C60.7443 48.0605 61.9349 47.447 63.0471 47.684C64.1331 47.9165 64.9115 48.9048 64.8406 50.0336C64.8093 50.5442 64.6733 51.0469 64.5847 51.5516L64.5888 51.5523C64.4999 52.0591 64.4531 52.5754 64.3127 53.0669ZM81.8111 53.4487C80.504 53.2068 79.1941 52.9687 77.8801 52.7655C77.4241 52.6939 77.1784 52.527 77.0373 52.0491C75.9882 48.4959 74.2215 45.3286 71.8436 42.5115C71.4521 42.0485 71.3678 41.6267 71.4739 41.0453C72.0233 38.0556 72.5387 35.0579 73.0598 32.0633C73.4026 30.0969 72.68 29.0512 70.7167 28.7866C66.2098 28.1807 62.0778 29.2014 58.3682 31.8633C57.8512 32.2342 57.4505 32.2981 56.8447 32.0828C46.1267 28.2623 35.5917 28.6466 25.4029 33.9085C19.3202 37.05 15.0471 41.8914 13.0166 48.5758C12.9873 48.6713 12.9463 48.7628 12.9155 48.8434C11.4532 48.8806 10.3089 47.3183 10.5063 45.8718C10.7141 44.3432 9.83296 43.2279 8.42106 43.1082C7.3435 43.0178 6.66552 43.6415 6.08973 44.4426L5.82234 45.9671C5.88854 46.5514 5.90031 47.1493 6.03379 47.7181C6.72019 50.656 8.52872 52.5278 11.413 53.3484C11.6314 53.4097 11.8525 53.4548 11.9444 53.4772C12.1235 55.4723 12.1763 57.4032 12.4914 59.2879C13.1741 63.3748 14.9478 67.0006 17.4584 70.2605C17.8215 70.7312 17.891 71.0833 17.6169 71.6247C16.9797 72.8829 16.4069 74.1775 15.821 75.4635C15.14 76.9595 15.5972 78.1998 17.0775 78.8916C20.4745 80.4819 23.8739 82.0704 27.2702 83.6648C27.5183 83.7817 27.7418 83.9447 27.9772 84.0867L29.1875 84.299C30.3521 83.9997 31.0223 83.2068 31.4441 82.1081C31.7465 81.3219 32.1464 80.5739 32.5209 79.7689L33.2381 79.8948C38.2733 80.7779 43.3067 81.6713 48.3457 82.532C48.93 82.6324 49.1706 82.8404 49.165 83.4541C49.1589 84.118 49.3127 84.7849 49.3211 85.4493C49.3337 86.6242 49.7482 87.5382 50.8152 88.0925L51.874 88.2782C53.7473 88.0823 55.6181 87.8776 57.493 87.6966C59.6289 87.4881 61.7676 87.3114 63.9048 87.1073C65.5424 86.9498 66.3809 85.9451 66.2467 84.2999C66.1299 82.8402 65.9966 81.3798 65.8525 79.9216C65.8104 79.4968 65.9061 79.224 66.3015 78.9766C69.1086 77.2095 71.5316 75.0079 73.5023 72.3221C73.7518 71.9799 73.9868 71.8868 74.3956 71.9669C75.7248 72.2252 77.0618 72.4514 78.3992 72.6754C79.9652 72.9375 81.0413 72.1696 81.321 70.5865C82.1596 65.8413 82.9921 61.095 83.8185 56.3476C84.0889 54.7944 83.3466 53.7306 81.8111 53.4487ZM50.8205 39.3674C50.4956 40.4601 49.3514 41.0818 48.265 40.757C38.9898 37.972 31.9894 42.4987 31.9212 42.5434C31.4663 42.8454 30.9371 42.9414 30.44 42.8542C29.9026 42.76 29.403 42.45 29.0799 41.9527C28.4596 41.0006 28.726 39.7193 29.6732 39.0925C30.0239 38.8624 38.3594 33.4684 49.4468 36.7978C50.5312 37.1223 51.1478 38.2731 50.8205 39.3674Z"
                                                fill="url(#paint0_linear_480_1581)" />
                                            <path
                                                d="M49.6313 23.5636C44.9947 22.7357 41.9619 18.3331 42.8081 13.6626C43.6519 9.00641 48.0243 5.97402 52.6912 6.80729C57.241 7.62001 60.2761 12.0692 59.4426 16.702C58.6097 21.3203 54.2296 24.3849 49.6313 23.5636Z"
                                                fill="url(#paint1_linear_480_1581)" />
                                        </g>
                                        <defs>
                                            <linearGradient id="paint0_linear_480_1581" x1="59.1993" y1="-30.8063"
                                                x2="38.7165" y2="85.9704" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="white" />
                                                <stop offset="0.885" stop-color="#9A88F5" />
                                            </linearGradient>
                                            <linearGradient id="paint1_linear_480_1581" x1="55.2947" y1="-8.58813"
                                                x2="49.6545" y2="23.5677" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="white" />
                                                <stop offset="0.885" stop-color="#9A88F5" />
                                            </linearGradient>
                                            <clipPath id="clip0_480_1581">
                                                <rect width="78.6209" height="80.3876" fill="white"
                                                    transform="translate(13.8867) rotate(9.94853)" />
                                            </clipPath>
                                        </defs>
                                    </svg>

                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @if (!$simpleMode)
            <div wire:key="physical-device">
                <img src="{{ asset('images/mac_mini.png') }}" alt="Mac Mini computer"
                    class="w-full max-w-xl mx-auto block" />
                <div
                    class="rounded-3xl bg-[#6b728033] p-8 -mt-32 sm:-mt-40 md:-mt-48 pt-32 grid grid-cols-1 gap-12 lg:grid-cols-2">
                    <div class="flex items-center justify-center">
                        <x-homepage.price-circle class="h-48 w-48 md:h-64 md:w-64 relative">
                            <div>
                                <span
                                    class="block text-center font-bold text-white text-2xl md:text-4xl">{{ number_format($this->price, 0, ',', '.') }}
                                    &euro;</span>
                                <span class="text-[#B2A4FA] text-center block text-lg">one time</span>
                            </div>
                        </x-homepage.price-circle>
                    </div>
                    <div>
                        <span class="block mb-4 text-lg font-bold text-white tracking-tight">
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
                    </div>
                </div>

                <div class="mt-24">
                    <h2
                        class="font-heading text-center text-4xl xs:text-5xl sm:text-6xl md:text-7xl font-medium text-secondary-gradient tracking-tight mb-6">
                        Get in touch
                    </h2>
                    <p class="text-center text-xl text-newGray-400">
                        Reach out, and let us help you save money by reducing your technical debt!
                    </p>
                    <div
                        class="mt-12 bg-white bg-opacity-5 rounded-3xl p-8 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                        <div>
                            <p class="font-heading text-left text-2xl md:text-3xl font-medium text-secondary-gradient">
                                Contact information
                            </p>
                            <p class="text-left text-lg text-newGray-400 mt-4">
                                Contact us today and find out how we can help you reduce your documentation and
                                onboarding
                                costs.
                            </p>
                            <div class="grid grid-cols-2 gap-4 mt-8">
                                <div>
                                    <label for="first-name" class="block font-bold text-white mb-1">
                                        First name:<sup>*</sup>
                                    </label>
                                    <input type="text" id="first-name"
                                        class="w-full p-2 bg-white bg-opacity-5 text-white rounded-md border border-white border-opacity-10"
                                        wire:model="companyFirstName" placeholder="John">
                                </div>
                                <div>
                                    <label for="last-name" class="block font-bold text-white mb-1">
                                        Last name:<sup>*</sup>
                                    </label>
                                    <input type="text" id="last-name"
                                        class="w-full p-2 bg-white bg-opacity-5 text-white rounded-md border border-white border-opacity-10"
                                        wire:model="companyLastName" placeholder="Doe">
                                </div>
                                <div class="col-span-2">
                                    <label for="company-email" class="block font-bold text-white mb-1">
                                        Company email:<sup>*</sup>
                                    </label>
                                    <input type="text" id="company-email"
                                        class="w-full p-2 bg-white bg-opacity-5 text-white rounded-md border border-white border-opacity-10"
                                        wire:model="companyEmail" placeholder="john.doe@example.com">
                                </div>
                                <div class="col-span-2">
                                    <label for="company-message" class="block font-bold text-white mb-1">
                                        Message:
                                    </label>
                                    <textarea id="company-message"
                                        class="w-full p-2 mb-8 bg-white bg-opacity-5 text-white rounded-md border border-white border-opacity-10 resize-none"
                                        wire:model="companyMessage" placeholder="Anything you want to add?"></textarea>
                                </div>
                            </div>

                            <button type="button" wire:click="askForDemoCall" wire:loading.attr="disabled"
                                class="group inline-flex w-full h-14 px-7 items-center justify-center text-base font-medium text-white bg-gradient-to-r from-[#6F3DEC] to-[#9121E9] transition duration-200 rounded-full">
                                <span class="mr-2">Ask for a demo call</span>
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17.9199 6.62C17.8185 6.37565 17.6243 6.18147 17.3799 6.08C17.2597 6.02876 17.1306 6.00158 16.9999 6H6.99994C6.73472 6 6.48037 6.10536 6.29283 6.29289C6.1053 6.48043 5.99994 6.73478 5.99994 7C5.99994 7.26522 6.1053 7.51957 6.29283 7.70711C6.48037 7.89464 6.73472 8 6.99994 8H14.5899L6.28994 16.29C6.19621 16.383 6.12182 16.4936 6.07105 16.6154C6.02028 16.7373 5.99414 16.868 5.99414 17C5.99414 17.132 6.02028 17.2627 6.07105 17.3846C6.12182 17.5064 6.19621 17.617 6.28994 17.71C6.3829 17.8037 6.4935 17.8781 6.61536 17.9289C6.73722 17.9797 6.86793 18.0058 6.99994 18.0058C7.13195 18.0058 7.26266 17.9797 7.38452 17.9289C7.50638 17.8781 7.61698 17.8037 7.70994 17.71L15.9999 9.41V17C15.9999 17.2652 16.1053 17.5196 16.2928 17.7071C16.4804 17.8946 16.7347 18 16.9999 18C17.2652 18 17.5195 17.8946 17.707 17.7071C17.8946 17.5196 17.9999 17.2652 17.9999 17V7C17.9984 6.86932 17.9712 6.74022 17.9199 6.62Z"
                                        fill="currentColor"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="hidden lg:block">
                            <img src="{{ asset('images/enterprise-robot.png') }}" alt="Robot with questions"
                                class="w-full h-auto" />
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>
