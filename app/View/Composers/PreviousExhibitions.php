<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class PreviousExhibitions extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.content-previous-exhibitions',
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            'previous_exhibitions' => $this->previousExhibitions(),
        ];
    }

    public function previousExhibitions()
    {
        $today = date('Ymd');
        $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
        $meta_query_val = get_query_var('artist_filter');
        
        $meta_query[] = array(
            'relation' => 'AND',
            array(
                'key' => 'start_date',
                'compare' => '<',
                'value' => $today,
            ),
            array(
                'key' => 'end_date',
                'compare' => '<',
                'value' => $today,
            ),
            array(
                'key' => 'off-site_exhibition',
                'compare' => '==',
                'value' => '0',
            ),
            'gallery_location_clause' => array(
                'key' => 'gallery_location',
                'compare' => 'EXISTS'
                )
            );
            
            if(!empty($meta_query_val)) {
                $meta_query[] = array(
                    'key' => 'artists',
                    'compare' => 'LIKE',
                    'value' => '"' . $meta_query_val . '"'
                );
            }
            
            $args = array(
                'post_type' => ['exhibition'],
                'meta_query' => array($meta_query),
                'paged' => $paged,
                'posts_per_page' => 10,
                'orderby' => ['start_date' => 'DESC', 'gallery_location_clause' => 'ASC'],
            );
            $post_query = new \WP_Query( $args );
            $exhibition_posts = $post_query->get_posts();
            // $display_year = 0;
            $big = 999999999; // need an unlikely integer

            $pagination = paginate_links( [
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, $paged ),
                'total' => $post_query->max_num_pages
            ] );        
    
            $previous_exhibitions_posts = empty($exhibition_posts) ? [] :
                array_map(function($exhibition_post)
                {
                    $artist_array = get_field('artists', $exhibition_post->ID);
                    
                    $artists = ($artist_array) ? array_map(
                        function ($artist) {
                            return ['post_title' => $artist->post_title];
                        },
                        $artist_array
                    ): [];
                    
                    $location = get_the_terms($exhibition_post->ID, 'location');
                    $term = array_pop($location);

                    $non_roster = get_field('artist_non-roster', $exhibition_post->ID) ?get_field('artist_non-roster', $exhibition_post->ID) : [];
                    $artists_non_roster = array_map(
                        function ($row) {
                            return $row['artist_non-roster_name'];
                        },
                        $non_roster
                    );
    
                    $start_date = get_field('start_date', $exhibition_post->ID);
                    return [
                    'permalink'          => get_permalink($exhibition_post->ID),
                    'title'              => get_the_title($exhibition_post->ID),
                    'term'               => $term->name,
                    'start_date'         => $start_date,
                    'display_start_date' => get_field('display_start_date', $exhibition_post->ID),
                    'end_date'           => get_field('end_date', $exhibition_post->ID),
                    'year'               => \DateTime::createFromFormat('M d, Y', $start_date)->format('Y'),
                    'artists'            => $artists,
                    'switch_title'       => get_field('switch_titleartist_order', $exhibition_post->ID) ? 1 : 0,
                    'show_title'         => get_field('display_exhibition_title', $exhibition_post->ID) ? get_field('display_exhibition_title', $exhibition_post->ID) : 0,
                    'artist_non_roster'  => $artists_non_roster,
                    'thumbnail'          => get_the_post_thumbnail($exhibition_post->ID, 'medium', ['class' => 'img-fluid']),
                    ];
                }, $exhibition_posts);

        $previous_exhibitions = [
            'previous_exhibitions_posts' => $previous_exhibitions_posts,
            'pagination'                 => $pagination,
        ];
        wp_reset_postdata();
        return $previous_exhibitions;
    }
}
