<footer class="relative py-12 sm:pt-24 bg-body overflow-hidden">
    <div class="relative container mx-auto px-4">
        <div
            class="absolute top-0 right-0 -mt-96 -mr-52 w-186 h-186 bg-gradient-to-t from-violet-700 via-darkBlue-900 to-transparent rounded-full filter blur-4xl">
        </div>
        <div class="relative">
            <div class="text-center mb-20">
                <a class="inline-block" href="{{ route('homepage') }}">
                    <x-application-logo class="h-20" :name="true" nameClass="text-4xl font-bold text-white" />
                </a>
            </div>
            <div class="pt-10 border-t border-gray-800">
                <div class="md:flex items-center justify-between">
                    <div class="mb-6 md:mb-0">
                        <span class="text-gray-600 tracking-tight">© {{ config('app.name') }}. All rights
                            reserved</span>
                    </div>
                    <div><a class="inline-block mr-10 text-white hover:underline tracking-tight"
                            href="{{ route('terms.show') }}">Terms &amp; Conditions</a><a
                            class="inline-block text-white hover:underline tracking-tight"
                            href="{{ route('policy.show') }}">Privacy
                            Policy</a></div>
                </div>
            </div>
        </div>
    </div>
</footer>
