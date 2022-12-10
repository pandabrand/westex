<article @php(post_class())>
  <header>
    <h1 class="entry-title">
      {!! $title !!}
    </h1>
    @if( $born_details )
      @foreach ( $born_details as $detail )
        <div>{{$detail['born_detail']}}</div>
        <div class="mb-2">{{$detail['work_detail']}}</div>
      @endforeach
    @endif
  </header>

  <div class="l-exhibition-featured-image mb-5">
    {!! $thumbnail !!}
    <div class="u-smalltext u-caption text-right">{{$alt_string}}</div>
  </div>
    
  <div class="entry-content">
    @php(the_content())
  </div>

  <footer>
    @if(count($artist_images))
      <div class="l-gallery">
        <div class="l-gallery-title">{{$artist_images['title']}}</div>
        <div class="l-gallery-images">
          @if(count($artist_images['collection']))
            <div class="grid">
              <div class="grid-sizer">
                @foreach($artist_images['collection'] as $image)
                  <div class="grid-item p-2">
                      <div class="l-gallery-item">
                          <a href="{{$image['url']}}" data-fancybox="gallery-images" data-caption="{{$image['caption']}}" class="we-fancybox-anchor">
                              <img src="{{$image['thumbnail']}}" alt="{{$image['title']}}" class="img-fluid" loading="lazy" width="{{ $image['thumbnail-w']}}" height="{{ $image['thumbnail-h']}}"/>
                              <div class="l-gallery-item--text u-smalltext u-caption mx-auto">
                                  {{$image['title']}}
                              </div>
                              <div class="we-fancybox-label">
                                  <span class="we-fancybox-title emphasis">{{$image['title']}}</span>
                                  <span class="we-fancybox-caption">{{$image['description']}}</span>
                              </div>
                          </a>
                      </div>
                  </div>
                @endforeach
              </div>
            </div>
          @endif
        </div>
      </div>
    @endif
    {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
  </footer>

</article>
