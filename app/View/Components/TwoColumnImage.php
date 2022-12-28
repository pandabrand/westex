<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TwoColumnImage extends Component
{
    use \App\Traits\Westex\WestexImage;
    public $narrow_class, $image_column_one, $image_column_two, $image_one_caption, $image_two_caption;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->image_column_one  = $this->getImage( $content['image_one'], $content['tc_image_size'], $content['tc_classes'] );
        $this->image_column_two  = $this->getImage( $content['image_two'], $content['tc_image_size'], $content['tc_classes'] );
        $this->image_one_caption = $content['image_one_caption'];
        $this->image_two_caption = $content['image_two_caption'];
        $this->narrow_class      = $content['narrow_class'];

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.two-column-image');
    }
}
