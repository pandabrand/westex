<div @class([
  'fluid-container', 
  'westex-vr-parent-page',
  'narrow' => $narrow_class
])>
  <div class="row">
    <div class="col-sm-12">
      <h2><a href="{{ $child_page_link }}">{{ $child_page_title }}</a></h2>
    </div>
    <div class="col-sm-12 col-md-6">
      <figure>
        {!! $parent_image !!}
        @if ( $parent_image_caption )
          <figcaption>{!! $parent_image_caption !!}</figcaption>
        @endif
      </figure>
    </div>
    <div class="col-sm-12 col-md-6">
      {!! $introduction_text !!}
    </div>
  </div>
</div>
