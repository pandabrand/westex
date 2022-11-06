<div class="container">
    @include('partials.front-exhibitions')
    @include('components.front-upcoming-exhibitions')
    @php(the_content())
    {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
</div>