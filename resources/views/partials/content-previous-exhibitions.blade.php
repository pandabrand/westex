<div class="container">
  @foreach( $previous_exhibitions['previous_exhibitions_posts'] as $exhibition )
    @if( isset($year) && $year !== $exhibition['year'] )
      <div class="row mb-5">
        <div class="col-md-12">
          <h2>{{ $year }}</h2>
        </div>
      </div>
    @elseif( !isset($year) )
      <div class="row mb-5">
        <div class="col-md-12">
          <h2>{{ $exhibition['year'] }}</h2>
        </div>
      </div>
    @endif
    <div class="row mb-5">
      <div class="col-md-6">
        @if( $exhibition['thumbnail'] )
            {!! $exhibition['thumbnail'] !!}
        @endif
      </div>
      <div class="col-md-6">
        @if($exhibition['switch_title'] == 0)
          @if($exhibition['show_title'] != 0)
            <div class="h3 emphasis"><a href="{{$exhibition['permalink']}}" title="{{ $exhibition['title'] }}">{{$exhibition['title']}}</a></div>
          @endif
        @endif
        <div class="d-flex flex-wrap mt-2">
          @if($exhibition['artists'])
            @foreach($exhibition['artists'] as $artist)
              <div class="strong h4 px-1">{!! $artist['post_title'] !!}</div>
            @endforeach
          @endif
          
          @if($exhibition['artist_non_roster'])
            @foreach($exhibition['artist_non_roster'] as $non_roster)
              <div class="strong h4 px-1">{{$non_roster}}</div>
            @endforeach
          @endif
        </div>
        @if($exhibition['switch_title'] != 0)
          @if($exhibition['show_title'] != 0)
            <div class="h3 emphasis"><a href="{{$exhibition['permalink']}}" title="{{ $exhibition['title'] }}">{!! $exhibition['title'] !!}</a></div>
          @endif
        @endif
        <div class="c-front-gallery_smalltype u-extra-v-margin u-label-font">{{$exhibition['start_date']}} - {{$exhibition['end_date']}}</div>
    </div>
  </div>
    @php
      $year = $exhibition['year']
    @endphp
  @endforeach
  <div class="d-flex flex-row justify-content-between mx-5 px-5">
    {!! $previous_exhibitions['pagination'] !!}
  </div>
</div>