<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FullWidthImage extends Component
{
    public $content;
    public $full_width_image;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->content = $content;
        $this->full_width_image = $this->getImage($content);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.full-width-image');
    }

    protected function getImage($data)
    {
        if (! isset( $data['image'] ) ) {
            return false;
        }

        return wp_get_attachment_image( $data['image'], $data['fw_image_size'], false, $data['image_classes'] );
    }
}
