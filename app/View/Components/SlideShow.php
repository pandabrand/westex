<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SlideShow extends Component
{
    public $flex_slideshow_images, $narrow_class;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->flex_slideshow_images = $this->slideshowImages($content['images'], $content['slideshow_size'], $content['slideshow_image_class']);
        $this->narrow_class          = $content['narrow_class'];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.slide-show');
    }

    protected function slideshowImages( $images, $slideshow_size, $slideshow_image_class )
    {
        return ( $images ) ? array_map(function($image) use ( $slideshow_size, $slideshow_image_class ) {
            return [
                'slide_img'     => wp_get_attachment_image( $image['image'], $slideshow_size, false, $slideshow_image_class ),
                'image_caption' => $image['image_caption'],
            ];
        }, $images) : [];
    }
}
