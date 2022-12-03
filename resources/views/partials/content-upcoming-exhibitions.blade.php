<div class="container">
  <div class="row">
    <div class="col-md-6 pl-0">
      <div class="h2 mb-4 u-label-font">Upcoming Exhibitions On-site</div>
        @foreach( $upcoming_exhibitions as $exhibition )
          <div class="l-front-gallery_row jsExhibitonLink" data-url="{{$exhibition['permalink']}}">
            <div class="c-front-gallery_smalltype u-label-font">
              {{$exhibition['term']}}
            </div>
            @if($exhibition['switch_title'] != 0)
              @if($exhibition['show_title'] != 0)
                <div class="h3 emphasis">{{$exhibition['title']}}</div>
              @endif
            @endif
            <div class="d-flex flex-wrap mt-2">
              @if($exhibition['artists'])
                @foreach($exhibition['artists'] as $artist)
                  <div class="strong pr-2">{{$artist->post_title}}</div>
                @endforeach
              @endif
              
              @if($exhibition['artist_non_roster'])
                @foreach($exhibition['artist_non_roster'] as $non_roster)
                  <div class="strong pr-2">{{$non_roster}}</div>
                @endforeach
              @endif
            </div>
            <div class="c-front-gallery_smalltype u-extra-v-margin u-label-font">{{$exhibition['start_date']}} - {{$exhibition['end_date']}}</div>
            @if( $exhibition['thumbnail'] )
                {!! $exhibition['thumbnail'] !!}
            @endif
          </div>
      @endforeach
    </div>
    <div class="col-md-6 pl-0">
      <div class="h2 mb-4 u-label-font">Current and Upcoming Exhibitions Off-site</div>
        @foreach( $off_site as $off_site_exhibition )
          <div class="l-front-gallery_row jsExhibitonLink" data-url="{{$off_site_exhibition['location_url']}}" data-title="{{$off_site_exhibition['location_title']}}">
            <div class="h3 mt-2">
              <a href="{{ $off_site_exhibition['location_url'] }}" target="_blank" rel="external noopener noreferrer" title="{{$off_site_exhibition['location_title']}}">
                @foreach($off_site_exhibition['artists'] as $artist)
                  <div>{{ $artist }}</div>
                @endforeach

                @foreach($off_site_exhibition['non_roster_artists'] as $non_roster_artist)
                  <div>{!! $non_roster_artist !!}</div>
                @endforeach
              </a>
            </div>
            <div class="strong emphasis">{{$off_site_exhibition['location_title']}}</div>
            <div class="news-name">{{ $off_site_exhibition['location_name'] }}</div>
            <div class="news-location">{!! $off_site_exhibition['location_address'] !!}</div>
            <div class="c-front-gallery_smalltype u-label-font">{{$off_site_exhibition['start_date']}} - {{$off_site_exhibition['end_date']}}</div>
            @if( $off_site_exhibition['thumbnail'] )
              <div>
                <a href="{{$off_site_exhibition['permalink']}}" title="{{$off_site_exhibition['thumbnail_title']}}">
                  {!! $off_site_exhibition['thumbnail'] !!}
                </a>
              </div>
            @endif
          </div>
      @endforeach
    </div>
  </div>
</div>
