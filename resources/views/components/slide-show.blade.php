<div @class([
  'container', 
  'westex-vr-slideshow',
  'what',
  'narrow' => $narrow_class
])>
  <div class="row justify-content-center">
    <div class="col-sm-12">
      <div id="westex-slide" class="carousel slide" data-interval="false">
        <div class="carousel-inner">
          @foreach ( $flex_slideshow_images as $flex_slideshow_image )
          <div @class([
            'carousel-item',
            'active' => $loop->first,
          ])>
            {!! $flex_slideshow_image['slide_img'] !!}
            @if ( $flex_slideshow_image['image_caption'] )
              <div class="carousel-caption d-none d-md-block">
                <p>{!! $flex_slideshow_image['image_caption'] !!}</p>
              </div>
            @endif
          </div>
          @endforeach
        </div>
        <a href="#westex-slide" class="carousel-control carousel-control-prev" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a href="#westex-slide" class="carousel-control carousel-control-next" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
</div>
