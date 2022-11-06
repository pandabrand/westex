@if( 0 < count($exhibitions) )
  <div class="container">
    <x-exhibition-panels :exhibitions="$exhibitions"/>
  </div>
@endif
