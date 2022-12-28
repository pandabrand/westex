<div @class([
  'fluid-container', 
  'westex-vr-two-column',
  'narrow' => $narrow_class
])>
  <div @class([
    'row',
    'flex-row' => $placement,
    'flex-row-reverse' => $reverse_placement,
    ])>
    <div class="col-sm-12 col-md-6">
      <figure>
        {!! $image_column !!}
        @if ( $image_column_caption )
          <figcaption>{!! $image_column_caption !!}</figcaption>
        @endif
      </figure>
    </div>
    <div class="col-sm-12 col-md-6 d-flex flex-column align-items-center justify-content-center">
      {!! $body_column !!}
    </div>
  </div>
</div>
