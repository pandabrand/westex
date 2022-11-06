<div @class([
  'fluid-container', 
  'westex-vr-two-image',
  'narrow' => $narrow_class
])>
  <div class="row justify-content-center">
    <div class="col-sm-12">
        <div class="image-container d-flex justify-content-center align-item-center">
          <figure>
            {!! $single_image !!}
            @if ( $image_caption )
            <figcaption>
              {!! $image_caption !!}
            </figcaption>
            @endif
          </figure>
        </div>
    </div>
  </div>
</div>
