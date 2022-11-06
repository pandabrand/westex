<header class="banner header-border">
  <nav class="navbar navbar-expand-md navbar-light l-main-navbar nav-primary" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
    <div class="container">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#bs4navbar" aria-controls="bs4navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="brand" href="{{ home_url('/') }}">
        <img src="@asset('images/2_LOGO_Word_Docs.jpg')" alt="Western exhibitions" srcset="@asset('images/2_LOGO_Word_Docs.jpg') 1x, @asset('images/2_LOGO_Word_Docs@2x.jpg') 2x">
      </a>
    
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu([
          'depth'           => 2,
          'theme_location'  => 'primary_navigation', 
          'menu_class'      => 'nav navbar-nav l-main-nav', 
          'container'       => 'div', 
          'container_id'    => 'bs4navbar', 
          'container_class' => 'collapse navbar-collapse l-main-navbar-wrapper', 
          'menu_id'         => false,
          'walker'          => new BS5NavWalker(),
        ]) !!}
      @endif
    </div>
  </nav>
</header>
