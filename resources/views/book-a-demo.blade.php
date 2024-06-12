<x-web-layout>
    @section('title', 'Book a demo | CodexAtlas')
    @section('og_title', 'Book a demo | CodexAtlas')
    @section('og_image', asset('images/enterprise-og.png'))

    <div class="relative container mx-auto px-4 py-12">
        <h2
            class="font-heading text-4xl text-center xs:text-5xl sm:text-6xl md:text-7xl font-medium text-white tracking-tight mb-8">
            Book a demo call
        </h2>
        <p class="text-xl text-gray-400 mb-4 text-center">
            Get to know how CodexAtlas can help you and your team reduce technical debt, onboarding costs and improve
            developer efficiency.
        </p>
        <div class="border-[1rem] border-darkBlue-700 rounded-xl mt-12">
            <video src="https://codex-atlas.s3.eu-west-3.amazonaws.com/demo.mp4" controls class="w-full"></video>
        </div>
        <div id="booking-page" class="mt-12">
            <!-- this is where we will inject the interface -->
        </div>
    </div>

    <script>
        window.SavvyCal = window.SavvyCal || function() {
            (SavvyCal.q = SavvyCal.q || []).push(arguments)
        };
    </script>
    <script async src="https://embed.savvycal.com/v1/embed.js"></script>
    <script>
        SavvyCal('init');
        SavvyCal('inline', {
            link: 'raullg/codex-demo',
            selector: '#booking-page'
        });
    </script>
</x-web-layout>
