@vite('resources/css/slider.scss')

<div class="swiper" :videos="$videos">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        @foreach ($videos as $video)
            <div class="swiper-slide">

                <iframe width="560" height="315" src="{{ $video->embeded }}" title="{{ $video->name }}" frameborder="0"
                    allow="web-share" allowfullscreen loading="lazy"></iframe>

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
@vite('resources/js/videosSlider.mjs')
