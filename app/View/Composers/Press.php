<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Press extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.content-press',
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            'publication_link'    => get_field('publication_link'),
            'article_description' => get_field('article_description'),
            'article_date'        => get_field('article_date'),
            'author_names'        => get_field('author_names'),
        ];
    }

}
