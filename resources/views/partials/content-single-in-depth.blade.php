@if ( isset( $parent_attributes['parent_post_id'] ) && $parent_attributes['parent_post_id'] && 1 < count( $parent_attributes['menu_array'] ))
  <div class="container westex-vr-parent-page">
    <div class="row">
      <div class="col-sm-12">
        <div class="dropdown in-depth-menu">
          <button id="id-depth-menu-button" class="in-depth-menu-button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ $parent_attributes['menu_title'] }} Menu <span class="caret"></span>
          </button>
          <ul class="dropdown-menu in-depth-menu-dropdown" aria-labelledby="in-depth-menu-button">
            @foreach ( $parent_attributes['menu_array'] as $link => $label )
              <li class="in-depth-menu-dropdown-item">
                <a href="{{$link}}">{{$label}}</a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
@endif    

@if( $flexible_content['content'] )
  @foreach( $flexible_content['content'] as $content )
    @switch( $content['content_type'] )
      @case( 'title-block' )
        @include('partials.flex-title-block', $content)
        @break

      @case( 'full-width-image' )
        @include('partials.flex-full-width-image', $content)
        @break
        
      @case( 'text-wide' )
        @include('partials.flex-text-wide', $content)
        @break

      @case( 'media' )
        @include('partials.flex-media', $content)
        @break

      @case( 'quote' )
        @include('partials.flex-quote', $content)
        @break

      @case( 'two-column-image' )
        @include('partials.flex-two-column-image', $content)
        @break

      @case( 'two-column' )
        @include('partials.flex-two-column', $content)
        @break

      @case( 'image' )
        @include('partials.flex-single-image', $content)
        @break

      @case( 'text' )
        @include('partials.flex-text', $content)
        @break

      @case( 'gallery' )
        @include('partials.flex-gallery', $content)
        @break

      @case( 'parent-page' )
        @include('partials.flex-parent-page', $content)
        @break

    @endswitch
  @endforeach
@endif