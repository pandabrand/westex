<div class="container">
  <div class="row">
    <div class="col-md-6 pl-0">
      <div class="h2 mb-4 u-label-font">Upcoming Exhibitions On-site</div>
        @foreach( $upcoming_exhibitions as $exhibition )
            <div class="mb-4">
              <div class="c-front-gallery_smalltype u-label-font">
                {!! $exhibition['term'] !!}
              </div>
              @if($exhibition['switch_title'] != 0)
                @if($exhibition['show_title'] != 0)
                  <div class="h3 emphasis">
                    <a href="{{$exhibition['permalink']}}">
                      {!! $exhibition['title'] !!}
                    </a>
                  </div>
                @endif
              @endif
              <div class="d-flex flex-wrap mt-2">
                @if($exhibition['artists'])
                  @foreach($exhibition['artists'] as $artist)
                    <div class="strong pr-2">{!! $artist->post_title !!}</div>
                  @endforeach
                @endif
                
                @if($exhibition['artist_non_roster'])
                  @foreach($exhibition['artist_non_roster'] as $non_roster)
                    <div class="strong pr-2">{!! $non_roster !!}</div>
                  @endforeach
                @endif
              </div>
              <div class="c-front-gallery_smalltype u-extra-v-margin u-label-font">{{$exhibition['start_date']}} - {{$exhibition['end_date']}}</div>
              @if( $exhibition['thumbnail'] )
                <a class="img-link" href="{{$exhibition['permalink']}}">
                  {!! $exhibition['thumbnail'] !!}
                </a>
              @endif
            </div>
      @endforeach
    </div>
    <div class="col-md-6 pl-0">
      <div class="h2 mb-4 u-label-font">Current and Upcoming Exhibitions Off-site</div>
        @foreach( $off_site as $off_site_exhibition )
          <div class="mb-4">
            @if ( $off_site_exhibition['artists'] || $off_site_exhibition['non_roster_artists'] )
              <div class="h3 mt-2">
                @if ($off_site_exhibition['artists'])
                  @foreach($off_site_exhibition['artists'] as $artist)
                    <div>{!! $artist !!}</div>
                  @endforeach
                @endif
                @if ($off_site_exhibition['artists'])
                  @foreach($off_site_exhibition['non_roster_artists'] as $non_roster_artist)
                    <div>{!! $non_roster_artist !!}</div>
                  @endforeach
                @endif
              </div>
            @endif
            <div class="strong emphasis">
              <a href="{{$off_site_exhibition['location_url']}}" title="{{$off_site_exhibition['location_title']}}" target="_blank" rel="noopener noreferrer">
                {!! $off_site_exhibition['location_title'] !!}
              </a>
            </div>
            <div class="news-name">{!! $off_site_exhibition['location_name'] !!}</div>
            <div class="news-location">{!! $off_site_exhibition['location_address'] !!}</div>
            <div class="c-front-gallery_smalltype u-label-font">{{$off_site_exhibition['start_date']}} - {{$off_site_exhibition['end_date']}}</div>
            @if( $off_site_exhibition['thumbnail'] )
              <div>
                <a class="img-link" href="{{$off_site_exhibition['permalink']}}" title="{{$off_site_exhibition['thumbnail_title']}}">
                  {!! $off_site_exhibition['thumbnail'] !!}
                </a>
              </div>
            @endif
          </div>
      @endforeach
    </div>
  </div>
</div>
