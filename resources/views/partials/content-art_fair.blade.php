<div class="row mb-4 art-fair">
  <div class="col-sm-6 py-2">
    @php(the_post_thumbnail( 'medium' ))
  </div>
  <div class="col-sm-6 py-2">
    <div class="d-flex flex-column mb-2 wex-flex-basis">
      <h2><a href="{{ the_permalink() }}" rel="follow">{!! $title !!}</a></h2>
      <div class="u-smalltext u-label-font">
        {!! $start_date !!}@if($end_date) - @endif{!! $end_date !!}
      </div>
    </div>
    @if($location)
      <div class="mb-2">{!! $location['address'] !!}</div>
    @endif
    @if($booth)
      <div class="mb-2 c-front-gallery_smalltype u-label-font">
        {!! $booth !!}
      </div>
    @endif
  </div>
</div>
