<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class FlexTwoColumn extends Composer
{
    protected static $views = [
        'partials.flex-two-column',
    ];

    public function with()
    {
        return [
            'image_column' => $this->image($this->data['content']['image'], $this->data['content']['tc_image_size'], $this->data['content']['tc_classes'], ),
            'body_column' => $this->data['content']['body'],
            'image_column_caption'  => $this->data['content']['image_caption'],
            'placement'  => $this->data['content']['placement'],
            'reverse_placement'  => ($this->data['content']['placement']) ? 0 : 1,
            'narrow_class'  => $this->data['content']['narrow_class'],
        ];
    }

    function image($image_id, $image_size, $image_classes)
    {
        return wp_get_attachment_image( $image_id, $image_size, false, $image_classes );
    }
}
