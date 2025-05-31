<article @php(post_class('pb-5'))>
  <header>
    <h1 class="emapsis entry-title">
      {!! $title !!}
    </h1>
  </header>

  <div class="entry-content">
    <div class="u-smalltext u-label-font">
      {!! $start_date !!}{{ ($end_date) ? ' - ' : ''}}{!! $end_date !!}
    </div>
    <div>
      {!! $location['address'] !!}
    </div>
    <div class="d-flex flex-wrap gap-4">
      @foreach ( $artists as $artist )
        <div class="pr-2 c-front-gallery_smalltype">{!! $artist !!}</div>
      @endforeach
      
      @foreach ( $artists_non_roster as $artist_non_roster )
        <div class="pr-2 c-front-gallery_smalltype">{!! $artist_non_roster !!}</div>
      @endforeach
    </div>

    @if ( $booth )
      <div class="my-2 c-front-gallery_smalltype u-label-font">{!! $booth !!}</div>
    @endif

    <div class="l-exhibition-featured-image mb-5">
      {!! $thumbnail !!}
      <div class="u-smalltext u-caption text-right">{!! $alt_string !!}</div>
    </div>
    @php(the_content())
  </div>

  <footer>
    <div class="grid">
      @foreach ( $gallery_images as $image )
          <div class="grid-item">
              <div class="l-gallery-item">
                  <a href="{{$image['href']}}" data-fancybox="gallery-images" data-caption="{{$image['caption']}}" class="we-fancybox-anchor">
                      <img src="{{$image['url']}}" alt="{{$image['title']}}" class="img-fluid" loading="lazy" width="{{ $image['url-w'] }}" height="{{ $image['url-h'] }}" />
                      <div class="l-gallery-item--text u-smalltext u-caption mx-auto">
                          {!! $image['title'] !!}
                      </div>
                      <div class="we-fancybox-label">
                          <span class="we-fancybox-title emphasis">{!! $image['title'] !!}</span>
                          <span class="we-fancybox-caption">{!! $image['description'] !!}</span>
                      </div>
                  </a>
              </div>
          </div>
      @endforeach
    </div>
    {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
  </footer>

</article>
