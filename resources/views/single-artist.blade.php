@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @includeFirst(['partials.content-single-' . get_post_type(), 'partials.content-single'])
  @endwhile
@endsection

@section('sidebar')
  <div class="c-sidebar-links u-label-font">
    @if($cv_file)
      <div class="c-sidebar-link">
        <a href="{{$cv_file['url']}}">CV Bio</a>
      </div>
    @endif
    <div>
      <a href="/press/?artist_filter={{get_the_ID()}}">Press</a>
    </div>
    <div>
      <a href="/previous-exhibitions/?artist_filter={{get_the_ID()}}">Exhibitions</a>
    </div>
  </div>
@endsection