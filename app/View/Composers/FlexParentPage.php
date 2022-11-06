<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class FlexParentPage extends Composer
{
    protected static $views = [
        'partials.flex-parent-page',
    ];

    public function with()
    {
        return [
            'parent_image' => $this->image($this->data['content']['image'], $this->data['content']['tc_image_size'], $this->data['content']['tc_classes'], ),
            'parent_image_caption'  => $this->data['content']['image_caption'],
            'child_page_link' => $this->data['content']['child_page_link'],
            'child_page_title'  => $this->data['content']['child_page_title'],
            'introduction_text'  => $this->data['content']['introduction_text'],
            'narrow_class'  => $this->data['content']['narrow_class'],
        ];
    }

    function image($image_id, $image_size, $image_classes)
    {
        return wp_get_attachment_image( $image_id, $image_size, false, $image_classes );
    }
}
