<div class="d-flex flex-row justify-content-between align-items-center mb-4 btn-group">
    <a href="#" role="button" class="btn btn-primary btn-location btn-chicago">Western Exhibitions</a>
    <a href="#" role="button" class="btn btn-primary btn-location btn-skokie">(northern)<br>Western Exhibitions</a>
    <a href="#" role="button" class="btn btn-primary btn-location btn-online">In Depth With&hellip;</a>
</div>
<div class="front-carousel">
    <div class="carousel-cell chicago">
        <x-carousel-cards :exhibitions="$exhibitions"/>
    </div>
    <div class="carousel-cell skokie">
        <x-carousel-cards :exhibitions="$northern_exhibitions"/>
    </div>
    <div class="carousel-cell online">
        <x-carousel-cards :exhibitions="$in_depth_posts"/>
    </div>
</div>