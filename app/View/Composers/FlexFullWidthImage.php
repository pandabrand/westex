<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class FlexFullWidthImage extends Composer
{
    protected static $views = [
        'partials.flex-full-width-image',
    ];

    public function with()
    {
        return [
            'full_width_image' => $this->image($this->data['content']),
            'narrow_class'  => $this->data['content']['narrow_class'],
        ];
    }

    function image($data)
    {
        return wp_get_attachment_image( $data['image'], $data['fw_image_size'], false, $data['image_classes'] );
    }
}
