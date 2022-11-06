<div class="card-group">
    @foreach ( $exhibitions as $exhibition )
        <div class="card">
            {!! $exhibition['thumbnail'] !!}
            <div class="card-body">
                <h3 class="card-title">{!! $exhibition['title'] !!}</h3>
                <div class="card-text d-flex flex-wrap">
                    @if($exhibition['artists'])
                        @foreach ($exhibition['artists'] as $artist)
                            <div class="strong pr-2">{!! $artist->post_title !!}</div>
                        @endforeach
                    @endif

                    @if(count($exhibition['non_roster_artists']) > 0)
                        @foreach($exhibition['non_roster_artists'] as $artist_non_roster_name)
                            <div class="strong pr-2">{!! $artist_non_roster_name !!}</div>
                        @endforeach
                    @endif
                </div>
                <p class="card-text mb-0 c-front-gallery_smalltype u-label-font">{!! $exhibition['start_date'] !!} - {!! $exhibition['end_date'] !!}</p>
                @isset( $exhibition['term'] )
                    <p class="card-text"><small><strong>{!! $exhibition['term'] !!}</strong>{!! $exhibition['term_location'] !!}</small></p>
                @endisset
                <a class="card-link" href="{{ $exhibition['permalink'] }}" title="{!! $exhibition['title'] !!}">More <i class="fa fa-arrow-right"></i> </a>
            </div>
        </div>
    @endforeach
</div>