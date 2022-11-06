<a class="visually-hidden-focusable sr-only focus:not-sr-only" href="#main">
  {{ __('Skip to content') }}
</a>

@include('sections.header')
  <div class="wrap container" role="document">
      <div class="content row">
        <main id="main" class="main">
          @yield('content')
        </main>

        @hasSection('sidebar')
          <aside class="sidebar">
            @yield('sidebar')
          </aside>
        @endif
      </div>
  </div>

@include('sections.footer')
