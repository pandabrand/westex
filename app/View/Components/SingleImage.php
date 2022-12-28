<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SingleImage extends Component
{
    public $single_image, $image_caption, $narrow_class;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->single_image  = $this->getImage($content['image'], $content['tc_image_size'], $content['tc_classes'] );
        $this->image_caption = $content['image_caption'];
        $this->narrow_class  = $content['narrow_class'];

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.single-image');
    }

    protected function getImage($image_id, $image_size, $image_classes)
    {
        if (! is_numeric( $image_id ) ) {
            return false;
        }

        return wp_get_attachment_image( $image_id, $image_size, false, $image_classes );
    }
}
