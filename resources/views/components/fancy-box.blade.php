<div class="grid-item p-2">
    <div class="l-gallery-item">
        <a href="{{$url}}" data-fancybox="gallery-images" data-caption="{{$caption}}" class="we-fancybox-anchor">
            <img src="{{$thumbnail}}" alt="{{$title}}" class="img-fluid" />
            <div class="l-gallery-item--text u-smalltext u-caption mx-auto">
                {{$title}}
            </div>
            <div class="we-fancybox-label">
                <span class="we-fancybox-title emphasis">{{$title}}</span>
                <span class="we-fancybox-caption">{{$description}}</span>
            </div>
        </a>
    </div>
</div>