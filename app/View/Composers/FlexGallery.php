<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class FlexGallery extends Composer
{
    protected static $views = [
        'partials.flex-gallery',
    ];

    public function with()
    {
        return [
            'flex_gallery_images' => $this->galleryImages($this->data['content']['gallery_images']),
            'narrow_class'        => $this->data['content']['narrow_class'],
        ];
    }

    function galleryImages( $images )
    {
        return ( $images ) ? array_map(function($image) {
            return [
                'href'           => ( 'video' == $image['type'] ) ? $image['url'] : $image['sizes']['large'],
                'gallery_string' => htmlentities(str_replace(PHP_EOL, ' ', $image['title'].' '.$image['description']), ENT_QUOTES),
                'src'            => $image['sizes']['large'],
                'title'          => $image['title'],
                'description'    => $image['description'],
            ];
        }, $images) : [];
    }
}
