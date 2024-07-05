<x-button class="w-full text-center text-xs flex justify-center items-center space-x-2" href="{{route('oauth.redirect', 'google')}}">
    <x-icons.google class="w-5 h-5"/>
    <span> {{ __('Google') }} </span>
</x-button>
