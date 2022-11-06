<div @class([
  'container', 
  'westex-vr-media',
  'narrow' => $narrow_class
])>
  <div class="row justify-content-center">
    <div class="col-sm-12">
      <div class="embed-container">
        {!! $media !!}
      </div>
      @if ( $media_caption )
        <div class="caption">
          {!! $media_caption !!}
        </div>
      @endif
    </div>
  </div>
</div>
