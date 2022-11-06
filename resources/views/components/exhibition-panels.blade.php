@foreach ( $exhibitions as $exhibition )
    <div class="row l-front-gallery_row">
        <div class="col-md-6 pl-0">
            <a class="no-decoration" href="{{ $exhibition['permalink'] }}" title="{{ $exhibition['title'] }}">
                <div class="jsExhibitionLink" >
                    <div class="c-front-gallery_smalltype u-label-font">
                        <strong>{!! $exhibition['term'] !!}</strong> {!! $exhibition['term_location'] !!}
                    </div>
                    @if(isset($exhibition['switch_title']) && $exhibition['switch_title'] == 1)
                        @if($exhibition['show_title'])
                            <div class="c-front-gallery_h1 emphasis">{!! $exhibition['title'] !!}</div>
                        @endif
                        <div class="d-flex flex-wrap">
                            @if($exhibition['artists'])
                                @foreach ($exhibition['artists'] as $artist)
                                    <div class="strong pr-2">{!! $artist->post_title !!}</div>
                                @endforeach
                            @endif

                            @if($exhibition['non_roster_artists'])
                                @foreach($exhibition['non_roster_artists'] as $artist_non_roster_name)
                                    <div class="strong pr-2">{!! $artist_non_roster_name !!}</div>
                                @endforeach
                            @endif
                        </div>
                    @else
                        <div class="d-flex flex-wrap c-front-gallery_h1">
                            @if($exhibition['artists'])
                                @foreach ($exhibition['artists'] as $artist)
                                <div class="pr-2">{!! $artist->post_title !!}</div>
                                @endforeach
                            @endif

                            @if($exhibition['non_roster_artists'])
                                @foreach($exhibition['non_roster_artists'] as $artist_non_roster_name)
                                <div class="pr-2">{!! $artist_non_roster_name !!}</div>
                                @endforeach
                            @endif
                        </div>
                        @if($exhibition['show_title'])
                            <div class="strong emphasis">{!! $exhibition['title'] !!}</div>
                        @endif
                    @endif
                    <div class="c-front-gallery_smalltype u-extra-v-margin u-label-font">{!! $exhibition['start_date'] !!} - {!! $exhibition['end_date'] !!}</div>
                </div>
            </a>
        </div>
        <div class="col-md-6 pr-0">
        @if( $exhibition['thumbnail'] )
            <a href="{{ $exhibition['permalink'] }}" title="{{ $exhibition['thumbnail_title'] }}">
                {!! $exhibition['thumbnail'] !!}
            </a>
            <div class="u-smalltext u-caption">
                {!! $exhibition['thumbnail_title'] !!}
            </div>
        @endif
        </div>
    </div>
@endforeach
