@if(count($upcoming_exhibitions) > 0)
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <div class="h3">Upcoming Exhibitions</div>
            @foreach ($upcoming_exhibitions as $upcoming)
            <div class="l-front-page_upcoming-exhibition">
                <div class="c-front-gallery_smalltype u-label-font">
                    {{ $upcoming['term'] }}
                </div>
                @if($upcoming['switch_title'] == 1)
                @if($upcoming['show_title'] == 1)
                    <div class="strong emphasis mb-2">
                        <a href="{{ $upcoming['permalink'] }}" title="{{ $upcoming['title'] }}">
                            {{ $upcoming['title'] }}
                        </a>
                    </div>
                @endif
                <div class="d-flex flex-wrap">
                    @foreach ($upcoming['artists'] as $artist)
                        @if($upcoming['show_title'] == 1)
                            <a href="{{ $upcoming['permalink'] }}">
                        endif
                        <div class="pr-2">{!! $artist['post_title'] !!}</div>
                        if($upcoming['show_title'] == 1)
                            </a>
                        @endif
                    @endforeach

                    @if($upcoming['show_title'] == 0)
                        <a href="$upcoming['permalink']">
                    @endif
                    @foreach($upcoming['artist_non_roster'] as $non_roster_name)
                        <div class="pr-2">{{ $non_roster_name }}</div>
                    @endforeach
                    @if($upcoming['show_title'] == 0)
                        </a>
                    @endif
                </div>
                @else
                    <div class="d-flex flex-wrap">
                        @foreach ($upcoming['artists'] as $artist)
                            @if($upcoming['show_title'] == 1)
                                <a href="{{ $upcoming['permalink'] }}">
                            endif
                            <div class="pr-2">{!! $artist['post_title'] !!}</div>
                            if($upcoming['show_title'] == 1)
                                </a>
                            @endif
                        @endforeach

                        @if($upcoming['show_title'] == 0)
                            <a href="$upcoming['permalink']">
                        @endif
                        @foreach($upcoming['artist_non_roster'] as $non_roster_name)
                            <div class="pr-2">{{ $non_roster_name }}</div>
                        @endforeach
                        @if($upcoming['show_title'] == 0)
                            </a>
                        @endif
                    </div>
                    @if($upcoming['show_title'] == 1)
                        <div class="strong emphasis mb-2">
                            <a href="{{ $upcoming['permalink'] }}" title="{{ $upcoming['title'] }}">
                                {{ $upcoming['title'] }}
                            </a>
                        </div>
                    @endif
                @endif
                <div class="u-label-font u-smalltext">{{ $upcoming['start_date'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
@endif