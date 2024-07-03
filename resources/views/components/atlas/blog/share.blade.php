<div class="text-white">
    <h2 class="font-display text-base sm:text-lg font-bold uppercase text-center sm:text-left">Share this page</h2>

    <div class="w-full flex space-x-2 mt-4 justify-center sm:justify-start">
        @php
            $pageTitle = $blog->title;
            $pageUrl = url()->current();
        @endphp

        <div x-data="{ showWhatsapp: false }" x-cloak @mouseenter="showWhatsapp = true" @mouseleave="showWhatsapp = false"
            class="cursor-pointer">
            <a href="https://api.whatsapp.com/send?text={{ urlencode($pageTitle . ' ' . $pageUrl) }}" class="whatsapp"
                target="_blank" title="Share on WhatsApp">
                <x-icons.whatsapp-filled x-show="showWhatsapp" class="w-8 h-8" />
                <x-icons.whatsapp-outlined x-show="!showWhatsapp" class="w-8 h-8" />
            </a>
        </div>
        <div x-data="{ showFacebook: false }" x-cloak @mouseenter="showFacebook = true" @mouseleave="showFacebook = false"
            class="cursor-pointer">
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($pageUrl) }}"class="facebook"
                target="_blank" title="Share on Facebook">
                <x-icons.facebook-filled x-show="showFacebook" class="w-8 h-8" />
                <x-icons.facebook-outlined x-show="!showFacebook" class="w-8 h-8" />
            </a>
        </div>

        <div x-data="{ showLinkedin: false }" x-cloak @mouseenter="showLinkedin = true" @mouseleave="showLinkedin = false"
            class="cursor-pointer">
            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode($pageUrl) }}&title={{ urlencode($pageTitle) }}"
                target="_blank" title="Share on LinkedIn">
                <x-icons.linkedin-filled x-show="showLinkedin" class="w-8 h-8" />
                <x-icons.linkedin-outlined x-show="!showLinkedin" class="w-8 h-8" />
            </a>
        </div>

        <div x-data="{ showTwitter: false }" x-cloak @mouseenter="showTwitter = true" @mouseleave="showTwitter = false"
            class="cursor-pointer">
            <a href="https://twitter.com/intent/tweet?url={{ urlencode($pageUrl) }}&text={{ urlencode($pageTitle) }}"
                target="_blank" title="Share on Twitter">
                <x-icons.twitter-filled x-show="showTwitter" class="w-8 h-8" />
                <x-icons.twitter-outlined x-show="!showTwitter" class="w-8 h-8" />
            </a>
        </div>
    </div>
</div>
