<?php

namespace App\Traits\Westex;

trait WestexImage {
    protected function getImage( $image_id, $image_size, $image_classes )
    {
        if ( ! is_numeric( $image_id ) ) {
            return false;
        }

        return wp_get_attachment_image( $image_id, $image_size, false, $image_classes );
    }
}