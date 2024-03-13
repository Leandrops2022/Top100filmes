@vite('resources/css/slider.scss')

<div class="swiper" :nosCinemas="$nosCinemas">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        @foreach ($nosCinemas as $filme)
            <div class="swiper-slide">
                <a href='{{ route('oldRouteRedirect', ['id' => $filme['id']]) }}'>
                    <img src='{{ "https://media.themoviedb.org/t/p/w300_and_h450_bestv2/$filme[poster_path]" }}'
                        alt='{{ "poster do filme $filme[title]" }}'>

                    <span class="text-white"> {{ $filme['title'] }}</span>
                </a>
            </div>
        @endforeach

        ...
    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

    <!-- If we need scrollbar -->
    <div class="swiper-scrollbar"></div>
</div>
@vite('resources/js/slider.mjs')
