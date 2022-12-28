<div {{ $attributes->class([
  'container', 
  'westex-vr-title',
  'x-westex-vr-title',
  'narrow' => $content['narrow_class']
]) }}>
<div class="row justify-content-md-start justify-content-sm-center">
    <div class="col-sm-10">
      <h1>{!! $content['title'] !!}</h1>
      @if( $artist )
        <div class="link">
          <a href="{{$artist['link']}}">{!! $artist['post_title'] !!}</a>
        </div>
      @endif
    </div>
  </div>
</div>