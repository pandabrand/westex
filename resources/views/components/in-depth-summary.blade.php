@foreach($in_depth_posts as $in_depth_post)
    <div class="row">
        <div class="col-md-6 mb-md-5">
            <div>
                <div class="c-front-gallery_smalltype u-label-font">Online Only: In Depth With...</div>
                <div class="strong pr-2">{!! $in_depth_post['artist_title'] !!}</div>
                <div class="c-front-gallery_h1 emphasis"><a href="{{ $in_depth_post['permalink'] }}" title="{{ $in_depth_post['title'] }}">{{ $in_depth_post['title'] }}</a></div>
                <div class="c-front-gallery_smalltype u-label-font">{!! $in_depth_post['start_date'] !!} - {{ $in_depth_post['end_date'] }}</div>
            </div>
        </div>
        <div class="col-md-6 mb-md-5">
            <a class="img-link" href="{{ $in_depth_post['permalink'] }}" title="{{ $in_depth_post['title'] }}">
                {!! $in_depth_post['thumbnail'] !!}
            </a>
        </div>
    </div>
@endforeach