<article @php( post_class('col-md-4 col-sm-6 col-xs-12 u-extra-v-margin') ) >
  <a href="{{ $link }}" title="{!! $title !!}">
    <header>
      {!! $medium_thumbnail !!}
    </header>

    <div class="entry-summary p-1">
      <div class="strong h4 text-center">{!! $title !!}</div>
    </div>
  </a>
</article>
