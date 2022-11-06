<article @php( post_class('col-md-4 col-sm-6 col-xs-12 u-extra-v-margin') ) >
  <a href="{{ $link }}" title="{!! $title !!}">
    <div class="d-flex flex-column justify-content-between h-100">
      <header>
        {!! $medium_thumbnail !!}
      </header>
      
      <div class="entry-summary p-1 text-center">
        <h3 class="entry-title text-center">{!! $title !!}</h3>
        @if ( $show_artist_name )
          @if ( $artist_name )
          <div class="strong h4">{!! $artist_name !!}</div>
          @endif
          @if ( $non_roster_artist_name )
          <div class="strong h4">{!! $non_roster_artist_name !!}</div>
          @endif
        @endif
      </div>
    </div>
  </a>
</article>
