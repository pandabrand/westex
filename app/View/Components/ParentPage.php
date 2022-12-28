<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ParentPage extends Component
{
    public $parent_image, $parent_image_caption, $child_page_link, $child_page_title, $introduction_text, $narrow_class;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->parent_image         = $this->getImage($content['image'], $content['tc_image_size'], $content['tc_classes'] );
        $this->parent_image_caption = $content['image_caption'];
        $this->child_page_link      = $content['child_page_link'];
        $this->child_page_title     = $content['child_page_title'];
        $this->introduction_text    = $content['introduction_text'];
        $this->narrow_class         = $content['narrow_class'];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.parent-page');
    }

    protected function getImage($image_id, $image_size, $image_classes)
    {
        if ( ! is_numeric( $image_id ) ) {
            return false;
        }

        return wp_get_attachment_image( $image_id, $image_size, false, $image_classes );
    }
}
