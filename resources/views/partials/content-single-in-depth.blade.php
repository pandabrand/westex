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

@php
  $args = array(
    'post_type'            => 'in-depth',
    'posts_per_page'       => '5',
    'loading_style'        => 'infinite fading-blocks',
    'scroll'               => 'true',
    'acf'                  => 'true',
    'acf_field_type'       => 'flexible',
    'acf_field_name'       => 'westex_blocks',
    'order'                => 'ASC',
  );	
  if(function_exists('alm_render')){
    alm_render($args);
  }
@endphp