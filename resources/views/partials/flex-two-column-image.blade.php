<div @class([
  'fluid-container', 
  'westex-vr-two-column-image',
  'narrow' => $narrow_class
])>
  <div class="row">
    <div class="col-sm-12 col-md-6">
        <figure>
          {!! $image_column_one !!}
          @if ( $image_one_caption )
            <figcaption>
              {!! $image_one_caption !!}
            </figcaption>
          @endif
        </figure>
    </div>
    <div class="col-sm-12 col-md-6">
        <figure>
          {!! $image_column_two !!}
          @if ( $image_two_caption )
            <figcaption>
              {!! $image_two_caption !!}
            </figcaption>
          @endif
        </figure>
    </div>
  </div>
</div>
