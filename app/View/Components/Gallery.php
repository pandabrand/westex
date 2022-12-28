<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Gallery extends Component
{
    public $flex_gallery_images, $narrow_class;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->flex_gallery_images = $this->galleryImages($content['gallery_images']);
        $this->narrow_class        = $content['narrow_class'];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.gallery');
    }

    protected function galleryImages( $images )
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
