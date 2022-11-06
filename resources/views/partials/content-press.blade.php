<article @php(post_class('my-4'))>
  <header>
    <h1 class="c-link h3">
      @if ($publication_link)
        <a href="{{$publication_link}}">{!! $title !!}</a>
      @else
        {!! $title !!}
      @endif
    </h1>
  </header>

  <div class="entry-content">
    {!! $article_description !!}
  </div>

  <footer>
    <div class="u-smalltext">{!! $author_names !!}, {!! $article_date !!}</div>
  </footer>
</article>
