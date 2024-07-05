<x-web-layout>
    @section('title', $blog->seo_title)
    @section('og_title', $blog->seo_title)
    @section('metadescription', $blog->seo_description)
    {{-- Hacer la og image de tailgraph en el modelo --}}
    @section('og_image', $blog->getTailGraphUrl())
    <div class="px-4 sm:px-6 lg:px-8 py-0 sm:py-12 max-w-[80rem] mx-auto relative z-10">
        {{ Breadcrumbs::render('blogDetail', $blog) }}
        <article class="mx-auto w-full relative flex justify-center">
            <div class="hidden lg:relative lg:block">
                <div
                    class="sticky top-0 -ml-0.5 h-max w-64 space-y-10 overflow-y-auto overflow-x-hidden py-16 pl-0.5 pr-8 xl:w-72 xl:pr-16">
                    <x-atlas.blog.navigation :blog="$blog" />

                    <x-atlas.blog.share :blog="$blog" />
                </div>
            </div>

            <div class="w-full">
                <h1 class="text-2xl sm:text-5xl font-bold text-left text-white mb-4 sm:mb-10">{{ $blog->title }}</h1>

                <div class="relative aspect-video rounded-xl overflow-hidden mx-auto my-10">
                    <img src="{{ $blog->image_url }}" alt="{{ $blog->image_alt }}"
                        class="absolute left-0 top-0 w-full h-full object-cover" />
                    <span
                        class="absolute top-4 right-4 bg-violet-500 text-white text-sm font-medium rounded-md px-2 py-1">{{ $blog->published_at->format('d-m-Y') }}</span>
                </div>

               <div class="block lg:hidden space-y-8">
                    <x-atlas.blog.navigation :blog="$blog" />

                    <x-atlas.blog.share :blog="$blog" />
               </div>

                <div class="prose prose-invert max-w-none mt-8 sm:mt-0" id="pageContent">
                    {!! $blog->transformed_content->html() !!}
                </div>


                <div class="mt-8 text-white w-full">
                    <livewire:tools.user-feedback :model="$blog" />
                </div>

            </div>

        </article>

        @if ($otherBlogs->count() > 0)
            <section class="max-w-[80rem] mx-auto mt-10 text-xl">
                <div class="w-full text-center mb-4 sm:mb-10">
                    <h2 class="text-2xl sm:text-4xl text-center text-secondary-gradient font-bold">
                        {{ __('Other blogs') }}</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($otherBlogs as $otherBlog)
                        <x-codex.blog.blog-card tag="h3" :blog="$otherBlog" />
                    @endforeach
                </div>
            </section>
        @endif
    </div>
    <script>
        function changeActiveItem(id) {
            var activeNavItem = document.querySelector('#pageNav .active');
            if (activeNavItem) {
                var liActiveItem = activeNavItem.closest('li');
                if(liActiveItem){
                    liActiveItem.classList.remove('border-secondary-gradient');
                    liActiveItem.classList.remove('border-l-4');
                    liActiveItem.classList.add('border-white');
                    liActiveItem.classList.add('border-l-2');
                }

                activeNavItem.classList.remove('active');
                activeNavItem.classList.remove('text-secondary-gradient');
                activeNavItem.classList.add('text-white');
            }

            var navItemToActivate = document.querySelector('#pageNav #nav-' + id);
            if (navItemToActivate) {
                var liNewActive = navItemToActivate.closest('li');
                if(liNewActive){
                    liNewActive.classList.remove('border-white');
                    liNewActive.classList.remove('border-l-2');
                    liNewActive.classList.add('border-secondary-gradient');
                    liNewActive.classList.add('border-l-4');
                }

                navItemToActivate.classList.add('active');
                navItemToActivate.classList.remove('text-white');
                navItemToActivate.classList.add('text-secondary-gradient');
            }
        }

        document.addEventListener('scroll', function() {
            var windowHeight = window.innerHeight;
            var scrollY = window.scrollY || window.pageYOffset;

            var headers = document.querySelectorAll('#pageContent h2, #pageContent h3');

            headers.forEach(function(header) {
                var rect = header.getBoundingClientRect();

                if (rect.top <= windowHeight / 3) {
                    changeActiveItem(header.id)
                }
            });
        });
    </script>

    {!! $schema->toScript() !!}
</x-web-layout>
