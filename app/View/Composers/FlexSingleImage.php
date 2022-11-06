<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class FlexSingleImage extends Composer
{
    protected static $views = [
        'partials.flex-single-image',
    ];

    public function with()
    {
        return [
            'single_image' => $this->image($this->data['content']['image'], $this->data['content']['tc_image_size'], $this->data['content']['tc_classes'], ),
            'image_caption'  => $this->data['content']['image_caption'],
            'narrow_class'  => $this->data['content']['narrow_class'],
        ];
    }

    function image($image_id, $image_size, $image_classes)
    {
        return wp_get_attachment_image( $image_id, $image_size, false, $image_classes );
    }
}
