<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class FlexTwoColumnImage extends Composer
{
    protected static $views = [
        'partials.flex-two-column-image',
    ];

    public function with()
    {
        return [
            'image_column_one' => $this->image($this->data['content']['image_one'], $this->data['content']['tc_image_size'], $this->data['content']['tc_classes'], ),
            'image_column_two' => $this->image($this->data['content']['image_two'], $this->data['content']['tc_image_size'], $this->data['content']['tc_classes'], ),
            'image_one_caption'  => $this->data['content']['image_one_caption'],
            'image_two_caption'  => $this->data['content']['image_two_caption'],
            'narrow_class'  => $this->data['content']['narrow_class'],
        ];
    }

    function image($image_id, $image_size, $image_classes)
    {
        return wp_get_attachment_image( $image_id, $image_size, false, $image_classes );
    }
}
