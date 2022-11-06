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

                    @if($exhibition['non_roster_artists'])
                        @foreach($exhibition['non_roster_artists'] as $artist_non_roster_name)
                            <div class="strong pr-2">{!! artist_non_roster_name !!}</div>
                        @endforeach
                    @endif
                </div>
                <p class="card-text"><small>In {!! $exhibition['term'] !!}</small></p>
            </div>
        </div>
    @endforeach
</div>