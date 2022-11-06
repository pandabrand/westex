<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class FlexSlideshow extends Composer
{
    protected static $views = [
        'partials.flex-slideshow',
    ];

    public function with()
    {
        return [
            'flex_slideshow_images' => $this->slideshowImages($this->data['content']['images'], $this->data['content']['slideshow_size'],$this->data['content']['slideshow_image_class']),
            'narrow_class'        => $this->data['content']['narrow_class'],
        ];
    }

    function slideshowImages( $images, $slideshow_size, $slideshow_image_class )
    {
        return ( $images ) ? array_map(function($image) use ( $slideshow_size, $slideshow_image_class ) {
            return [
                'slide_img'     => wp_get_attachment_image( $image['image'], $slideshow_size, false, $slideshow_image_class ),
                'image_caption' => $image['image_caption'],
            ];
        }, $images) : [];
    }
}
