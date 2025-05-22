<article @php(post_class('pb-5'))>
  <header>

    @if( $switch_title == 1 )
      @if( $show_title == 1 )
        <h1 class="emphasis h1">
          {!! $title !!}
        </h1>
      @endif
    @endif
    
    <div class="d-flex flex-wrap justify-content-between">
      @foreach($artists as $artist)
        <div class="pr-2 h2">
          <a href="{{ $artist['permalink'] }}">{!! $artist['title'] !!}</a>
        </div>
      @endforeach

      @foreach($non_roster_artists as $non_roster_artist)
        <div class="pr-2 h2">{!! $non_roster_artist !!}</div>
      @endforeach
    </div>

    @if( $switch_title != 1 )
      @if( $show_title == 1 )
        <h1 class="emphasis h3">
          {!! $title !!}
        </h1>
      @endif
    @endif
  </header>

  <div class="entry-content">
    <div class="u-extra-v-margin u-label-font">
      {{ $start_date }} - {{ $end_date }}<br/>
      @if($off_site_exhibition == 0)
        <strong>{!! $term !!}</strong>{!! $term_location !!}
      @endif
    </div>
    <div class="l-exhibition-featured-image mb-5">
      {!! $thumbnail !!}
      <div class="u-smalltext u-label-font text-left">{!! $thumbnail_title !!}</div>
    </div>
    @if($off_site_exhibition == 1)
      <div>
        @if($off_site_url)
          <a href="{{ $off_site_url }}" target="_blank">{!! $off_site_details !!}</a>
        @else
          {!! $off_site_details !!}
        @endif
      </div>
    @endif
    @php(the_content())
  </div>

  <footer>
    <div class="grid">
      @foreach($exhibition_images as $exhibition_image)
        <div class="grid-item">
          <div class="l-gallery-item">
            <a href="{{ $exhibition_image['href'] }}" data-fancybox="gallery-images" data-caption="{{ $exhibition_image['gallery_string'] }}" class="we-fancybox-anchor">
              <img src="{{ $exhibition_image['src'] }}" alt="{{ $exhibition_image['title'] }}" class="img-fluid">
              <div class="l-gallery-item--text u-smalltext u-caption mx-auto">
                {!! $exhibition_image['title'] !!}
              </div>
              <label class="we-fancybox-label">
                <span class="we-fancybox-title emphasis">{!! $exhibition_image['title'] !!}</span>
                <span class="we-fancybox-caption">{!! $exhibition_image['description'] !!}</span>
              </label>
            </a>
          </div>
        </div>
      @endforeach
    </div>
    {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
  </footer>

</article>
