<div @class([
  'container', 
  'westex-vr-slideshow',
  'narrow' => $narrow_class
])>
  <div class="row justify-content-center">
    <div class="col-sm-12">
      <div class="grid">
        @foreach ( $gallery_images as $flex_image )
          <div class="grid-item">
            <div class="l-gallery-item">
              <a href="{{ $flex_image['href'] }}" data-fancybox="gallery-images" data-caption="{{ $flex_image['gallery_string'] }}"  class="we-fancybox-anchor">
                <img class="img-fluid" src="{{ $flex_image['src'] }}">
                <div class="l-gallery-item--text u-smalltext u-caption mx-auto">
                  {!! $flex_image['title'] !!}
                </div>
                <label class="we-fancybox-label">
                  <span class="we-fancybox-title emphasis">{!! $flex_image['title'] !!}</span>
                  <span class="we-fancybox-caption">{!! $flex_image['description'] !!}</span>
                </label>
              </a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
