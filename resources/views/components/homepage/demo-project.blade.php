@props(['project'])
<a href="{{ $project->url }}" target="_blank"
    {{ $attributes->merge(['class' => 'relative group sm:flex-shrink-0 flex items-end p-6 sm:mr-8 w-full sm:w-128 h-80 rounded-3xl overflow-hidden']) }}>
    <img class="absolute top-0 left-0 w-full h-full object-cover" src="{{ asset($project->imageUrl) }}" alt="">
    <div class="relative block w-full p-6 rounded-3xl overflow-hidden">
        <div
            class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-40 group-hover:bg-opacity-50 rounded-3xl backdrop-filter backdrop-blur-md transition duration-75">
        </div>
        <div class="relative flex items-center justify-between">
            <div class="max-w-xs">
                <h3 class="text-3xl text-white font-medium mb-2">{{ $project->name }}</h3>
                <p class="text-sm text-white">{{ $project->description }}</p>
            </div>
            <div>
                <svg width="32" height="32" viewbox="0 0 32 32" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M23.8933 8.82667C23.758 8.50087 23.4991 8.24197 23.1733 8.10667C23.013 8.03835 22.8409 8.00211 22.6667 8H9.33333C8.97971 8 8.64057 8.14048 8.39052 8.39052C8.14047 8.64057 8 8.97971 8 9.33333C8 9.68696 8.14047 10.0261 8.39052 10.2761C8.64057 10.5262 8.97971 10.6667 9.33333 10.6667H19.4533L8.38667 21.72C8.26169 21.844 8.1625 21.9914 8.09481 22.1539C8.02712 22.3164 7.99227 22.4907 7.99227 22.6667C7.99227 22.8427 8.02712 23.017 8.09481 23.1794C8.1625 23.3419 8.26169 23.4894 8.38667 23.6133C8.51062 23.7383 8.65808 23.8375 8.82056 23.9052C8.98304 23.9729 9.15732 24.0077 9.33333 24.0077C9.50935 24.0077 9.68362 23.9729 9.8461 23.9052C10.0086 23.8375 10.156 23.7383 10.28 23.6133L21.3333 12.5467V22.6667C21.3333 23.0203 21.4738 23.3594 21.7239 23.6095C21.9739 23.8595 22.313 24 22.6667 24C23.0203 24 23.3594 23.8595 23.6095 23.6095C23.8595 23.3594 24 23.0203 24 22.6667V9.33333C23.9979 9.1591 23.9617 8.98696 23.8933 8.82667Z"
                        fill="white"></path>
                </svg>
            </div>
        </div>
    </div>
</a>
