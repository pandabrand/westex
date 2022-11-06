<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Post extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.page-header',
        'partials.content',
        'partials.content-*',
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            'title' => $this->title(),
            'location_url' => get_field('location_url'),
            'location_name' => get_field('location_name'),
            'location_address' => get_field('location_address'),
            'start_date' => $this->startDate(),
            'end_date' => $this->endDate(),
            'press_reviews' => $this->pressReviews(),
            'title_tags' => $this->titleTags(),
            'artist_name' => $this->artistName(),
        ];
    }

    /**
     * Returns the post title.
     *
     * @return string
     */
    public function title()
    {
        if ($this->view->name() !== 'partials.page-header') {
            return get_the_title();
        }

        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }

            return __('Latest Posts', 'sage');
        }

        if (is_archive()) {
            return get_the_archive_title();
        }

        if (is_search()) {
            return sprintf(
                /* translators: %s is replaced with the search query */
                __('Search Results for %s', 'sage'),
                get_search_query()
            );
        }

        if (is_404()) {
            return __('Not Found', 'sage');
        }

        return get_the_title();
    }

    /**
     * Artists post info
     * 
     * @return string
     */
    public function artistName()
    {
        $artists = get_field('artist');
        $artist_name = '';
        if($artists) {
          $artist_names = array_map(function($artist) { return ucwords(strtolower($artist->post_title)); }, $artists);
          $artist_count = count($artist_names);
          if($artist_count > 2) {
            $last_artist_name = array_pop($artist_names);
            $artist_name = implode(', ',$artist_names);
            $artist_name .= ' and '.$last_artist_name;
          } else {
            $artist_name = implode(' and ', $artist_names);
          }
        }
        return $artist_name;
    }

    /**
     * Title tags
     * 
     * @return string
     */
    public function titleTags()
    {
        $title_tags = '';
        if(get_the_tags()) {
          $tag_names = array_map(function($this_tag) { return $this_tag->name; }, get_the_tags());
          $title_tags = implode(', ', $tag_names);
        }
        return $title_tags;
    }

    /**
     * Press Reviews
     * 
     * @return array
     */
    public function pressReviews()
    {
        $reviews = get_field('pressreviews');

        if($reviews) {
            return array_map(
                function($review)
                {
                    return ['press_url' => $review['press_url'], 'press_title' => $review['press_title']];
                },
                $reviews
            );
        } else {
            return false;
        }
    }

    /**
     * End date
     * 
     * @return string
     */
    public function endDate()
    {
        $end_date = get_field('end_date');
        $date = new \DateTime($end_date);
        return $date->format('F j, Y') ?? '';
    }

    /**
     * End date
     * 
     * @return string
     */
    public function startDate()
    {
        $start_date = get_field('start_date');
        $date = new \DateTime($start_date);
        return $date->format('F j, Y') ?? '';
    }
}
