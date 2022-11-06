<article @php(post_class('my-4'))>
  <header>
    <h3 class="entry-title">
      @if($location_url)
        <a href="{{ $location_url }}" target="_blank">
      @endif
      <span>{!! $artist_name !!} </span><br/>
      <span class="emphasis">{!! $title !!} </span>
      <span>{!! $title_tags !!} </span>
      @if($location_url)
        </a>
      @endif
    </h3>
  </header>

  <div class="entry-summary pl-4">
    <div class="news-title">{!! $location_name !!}</div>
    <div class="news-address">{!! $location_address !!}</div>
    <div class="news-date">{!! ($start_date) ? $start_date : '' !!}{!! ($end_date) ? ' - ' : '' !!}{!! ($end_date) ? $end_date : '' !!}</div>
    @if($press_reviews)
      <div class="d-flex flex-wrap news-pressreviews">
        @foreach($press_reviews as $review)
          <div class="p-2">
            @if($review['press_url'])
              <a href="{{ $review['press_url'] }}" target="_blank" rel="noopener noreferrer">
            @endif
            {!! $press_title !!}
            @if($review['press_url'])
              </a>
            @endif
          </div>
        @endforeach
      </div>
    @endif
    <div class="news-content">
      @php(the_content())
    </div>
  </div>
</article>
